<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone'   => 'required|string',
            'welayat' => 'required|string',
            'city'    => 'required|string',
            'address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Sebetiňiz boş!');
        }

        $deliveryRates = [
            'ashgabat' => ['Aşgabat şäheri' => 20],
            'ahal'     => ['Änew' => 30, 'Gökdepe' => 40, 'Bäherden' => 50, 'Kaka' => 50, 'Tejen' => 60],
            'balkan'   => [
                'Türkmenbaşy ş.' => 50,
                'Mikraýon' => 50,
                'Janga' => 60,
                'Ufra' => 60,
                'Awaza' => 100,
                'Gyýanlyk' => 70,
                'Guwlumaýak' => 70,
                'Belek' => 60,
                'Jebel' => 70,
                'Nebitdag' => 70,
                'Gyzylarbat' => 70,
                'Bizmergen' => 80,
                'Çeleken / Hazar' => 80,
                'Bekdaş / Garabogaz' => 80,
                'Gumdag' => 80,
                'Gazanjyk / Bereket' => 90,
                'Serdar' => 90,
                'Esenguly' => 90,
                'Etrek' => 100
            ],
            'lebap'    => [
                'Türkmenabat ş.' => 50,
                'Serdarabat' => 70,
                'Dänew' => 70,
                'Sakar' => 70,
                'Seýdi' => 80,
                'Saýat' => 80,
                'Garabekewül' => 80,
                'Farap' => 80,
                'Darganata' => 80,
                'Halaç' => 80,
                'Kerki' => 80,
                'Hojambaz' => 90,
                'Amyderýa' => 90,
                'Köýtendag' => 100,
                'Gazojak' => 100,
                'Magdanly' => 100,
                'Döwletli' => 100
            ],
            'mary'     => [
                'Mary ş.' => 50,
                'Ýölöten' => 70,
                'Murgap' => 70,
                'Türkmengala' => 70,
                'Baýramaly' => 70,
                'Wekilbazar' => 70,
                'Garagum' => 80,
                'Sakarçäge' => 80,
                'Oguzhan' => 80,
                'Şatlyk' => 80,
                'Tagtabazar' => 90
            ],
            'dasoguz'  => [
                'Daşoguz ş.' => 50,
                'Akdepe' => 70,
                'Gurbansoltan' => 70,
                'Gubadag' => 70,
                'S.A.Nyýazow' => 70,
                'Şabat' => 80,
                'Türkmenbaşy etr.' => 80,
                'Boldumsaz' => 70,
                'Görogly' => 80,
                'Köneürgenç' => 100,
                'Ruhybelent' => 60,
                'Täze oba' => 60,
                'Gülüstan' => 60
            ]
        ];
        $welayatKey = mb_strtolower(trim($validated['welayat']), 'UTF-8');
        $deliveryFee = $deliveryRates[$welayatKey][$validated['city']] ?? 0;

        $itemsTotal = 0;
        foreach ($cart as $item) {
            $price = (float) ($item['price'] ?? 0);
            $qty = (int) ($item['quantity'] ?? 1);
            $itemsTotal += $price * $qty;
        }

        $grandTotal = $itemsTotal + $deliveryFee;
        $fullAddress = ucfirst($validated['welayat']) . ', ' . $validated['city'] . ', ' . $validated['address'];

        $digits = preg_replace('/[^0-9]/', '', $validated['phone']);
        if (str_starts_with($digits, '993')) {
            $formattedPhone = '+' . $digits;
        } elseif (str_starts_with($digits, '8')) {
            $formattedPhone = '+993' . substr($digits, 1);
        } else {
            $formattedPhone = '+993' . $digits;
        }

        $order = DB::transaction(function () use ($validated, $formattedPhone, $fullAddress, $deliveryFee, $grandTotal, $cart) {
            $order = Order::create([
                'user_id'      => Auth::check() ? Auth::id() : null,
                'phone'        => $formattedPhone,
                'welayat'      => $validated['welayat'],
                'city'         => $validated['city'],
                'address'      => $fullAddress,
                'delivery_fee' => $deliveryFee,
                'total_price'  => $grandTotal,
                'status'       => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['id'] ?? $productId,
                    'quantity'   => (int) ($item['quantity'] ?? 1),
                    'price'      => (float) ($item['price'] ?? 0),
                ]);
            }

            return $order;
        });

        $userOrders = session()->get('user_orders', []);
        if (!is_array($userOrders)) {
            $userOrders = [];
        }
        $userOrders[] = (int) $order->id;
        session()->put('user_orders', array_values(array_unique($userOrders)));

        // Очистка корзины
        session()->forget('cart');

        return redirect()->route('home.index')->with('success', 'Sargydyňyz üstünlikli kabul edildi!');
    }

    public function myOrders()
    {
        $rawOrders = session()->get('user_orders', []);
        $userOrdersIds = is_array($rawOrders) ? array_values(array_filter(array_map('intval', $rawOrders))) : [];

        $categories = Category::all();
        $query = Order::with('items.product')->latest();

        if (Auth::check()) {
            $query->where(function ($q) use ($userOrdersIds) {
                $q->where('user_id', Auth::id());
                if (!empty($userOrdersIds)) {
                    $q->orWhereIn('id', $userOrdersIds);
                }
            });
        } else {
            if (!empty($userOrdersIds)) {
                $query->whereIn('id', $userOrdersIds);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        $orders = $query->paginate(10);

        return view('client.orders.index', compact('orders', 'categories'));
    }
}
