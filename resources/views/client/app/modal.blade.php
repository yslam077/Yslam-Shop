<div class="modal fade" id="loginModal" tabindex="-1" aria-label="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content border-0 p-3" style="border-radius: 10px;">
            <div class="modal-header border-0 pb-0">
                <h1 class="modal-title fw-bolder text-primary" id="loginModalLabel">
                    Yslam <span class="fw-bolder" style="color: rgb(255, 136, 156)">shop.com</span>
                </h1>
                <button type="button" class="btn-close ms-auto pt-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body pt-3">
                <!-- Вкладки: Girmek и Agza bolmak -->
                <div class="px-3 pt-2">
                    <ul class="nav nav-tabs border-bottom" style="font-size: 0.95rem;">
                        <li class="nav-item">
                            <a class="nav-link active custom-tab px-0 me-4 fw-bold fs-3" href="#" id="tabGirmek">Girmek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-muted custom-tab px-0 fw-bold fs-3" href="#" id="tabAgza">Agza bolmak</a>
                        </li>
                    </ul>
                </div>

                <!-- Единая форма с динамическим action -->
                <form id="authForm" action="{{ route('admin.login.process') }}" method="POST" class="mt-2">
                    @csrf

                    <!-- Поле ИМЯ (Только для регистрации) -->
                    <div class="mb-3 d-none" id="nameBlock">
                        <h4 class="fw-bolder text-muted">
                            <label for="userNameInput">Adyňyz:</label>
                        </h4>
                        <input type="text" name="name" id="userNameInput"
                               class="form-control container-md bg-light border-0 py-2 px-3"
                               style="border-radius: 8px;" placeholder="Adyňyzy ýazyň">
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <h4 class="fw-bolder text-muted">
                            <label for="userEmailInput">E-mail:</label>
                        </h4>
                        <input type="email" name="email" id="userEmailInput" required
                               class="form-control container-md bg-light border-0 py-2 px-3"
                               style="border-radius: 8px;" placeholder="E-mail poçtaňyz">
                    </div>

                    <!-- Пароль -->
                    <div class="mb-3">
                        <h4 class="fw-bolder text-muted">
                            <label for="passwordInput">Parol:</label>
                        </h4>
                        <div class="position-relative">
                            <input type="password" name="password" id="passwordInput" required
                                   class="form-control bg-light border-0 py-2 px-3 pe-5" style="border-radius: 8px;" placeholder="Parolyňyz">
                            <i id="togglePassword"
                               class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                               style="cursor: pointer; z-index: 10; font-size: 1.2rem;"></i>
                        </div>
                    </div>

                    <!-- Поле ПОДТВЕРЖДЕНИЕ ПАРОЛЯ (Только для регистрации) -->
                    <div class="mb-3 d-none" id="confirmPasswordBlock">
                        <h4 class="fw-bolder text-muted">
                            <label for="passwordConfirmInput">Parol tassyklaň:</label>
                        </h4>
                        <div class="position-relative">
                            <input type="password" name="password_confirmation" id="passwordConfirmInput"
                                   class="form-control bg-light border-0 py-2 px-3 pe-5" style="border-radius: 8px;" placeholder="Paroly gaýtalaň">
                            <i id="toggleConfirmPassword"
                               class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 text-muted"
                               style="cursor: pointer; z-index: 10; font-size: 1.2rem;"></i>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-lg w-100 btn-success fw-bolder text-light border-0 mt-3">
                        Girmek
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabGirmek = document.getElementById('tabGirmek');
        const tabAgza = document.getElementById('tabAgza');
        const nameBlock = document.getElementById('nameBlock');
        const userNameInput = document.getElementById('userNameInput');
        const confirmPasswordBlock = document.getElementById('confirmPasswordBlock');
        const confirmPasswordInput = document.getElementById('passwordConfirmInput');
        const authForm = document.getElementById('authForm');
        const submitBtn = document.getElementById('submitBtn');

        if (tabGirmek && tabAgza) {
            // Режим "Girmek" (Вход)
            tabGirmek.addEventListener('click', function (e) {
                e.preventDefault();
                tabGirmek.classList.add('active');
                tabGirmek.classList.remove('text-muted');
                
                tabAgza.classList.remove('active');
                tabAgza.classList.add('text-muted');

                // Скрываем поля для регистрации
                nameBlock.classList.add('d-none');
                userNameInput.removeAttribute('required');
                
                confirmPasswordBlock.classList.add('d-none');
                confirmPasswordInput.removeAttribute('required');

                submitBtn.textContent = "Girmek";
                
                // Перенаправляем форму на универсальный роут входа
                authForm.action = "{{ route('admin.login.process') }}";
            });

            // Режим "Agza bolmak" (Регистрация)
            tabAgza.addEventListener('click', function (e) {
                e.preventDefault();
                tabAgza.classList.add('active');
                tabAgza.classList.remove('text-muted');
                
                tabGirmek.classList.remove('active');
                tabGirmek.classList.add('text-muted');

                // Показываем поля для регистрации
                nameBlock.classList.remove('d-none');
                userNameInput.setAttribute('required', 'required');

                confirmPasswordBlock.classList.remove('d-none');
                confirmPasswordInput.setAttribute('required', 'required');

                submitBtn.textContent = "Agza bolmak";

                // Перенаправляем форму на роут обычной регистрации
                authForm.action = "{{ route('register') }}"; 
            });
        }

        // Переключение видимости пароля (глазок)
        function setupTogglePassword(iconId, inputId) {
            const icon = document.getElementById(iconId);
            const input = document.getElementById(inputId);
            
            if(icon && input) {
                icon.addEventListener('click', function () {
                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');
                    icon.classList.toggle('bi-eye', !isPassword);
                    icon.classList.toggle('bi-eye-slash', isPassword);
                });
            }
        }

        setupTogglePassword('togglePassword', 'passwordInput');
        setupTogglePassword('toggleConfirmPassword', 'passwordConfirmInput');
    });
</script>
