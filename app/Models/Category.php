<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_tk',
        'name_ru',
        'name_en',
        'slug',
    ];

    public function getNameAttribute(): string
    {
        $locale = app()->getLocale(); 
        $field = 'name_' . $locale;

        return $this->{$field} ?? $this->name_tk ?? '';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}