@php
    // Ýalňyşlykdan soň (register) doldurylan bolsa, "Agza bolmak" tabyny açyk goýýarys
    $lmStartRegister = old('name') !== null || $errors->has('name') || $errors->has('password_confirmation');
@endphp

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm-dialog">
        <div class="modal-content lm-content">

            <button type="button" class="btn-close btn-close-white lm-close" data-bs-dismiss="modal" aria-label="Close"></button>

            {{-- ================= BAŞY ================= --}}
            <div class="lm-hero">
                <div class="lm-hero-ico"><i class="bi bi-person-fill" id="lmHeroIcon"></i></div>
                <h2 class="lm-logo" id="loginModalLabel">
                    Yslam <span>shop.com</span>
                </h2>
                <p class="lm-hero-sub" id="lmSubtitle">Hasabyňyza giriň we söwda ediň</p>
            </div>

            <div class="modal-body lm-body">

                {{-- ================= TAB SYÇAN ================= --}}
                <div class="lm-tabs" id="lmTabs" data-mode="login">
                    <span class="lm-indicator"></span>
                    <button type="button" class="lm-tab active" id="tabGirmek">
                        <i class="bi bi-box-arrow-in-right"></i> Girmek
                    </button>
                    <button type="button" class="lm-tab" id="tabAgza">
                        <i class="bi bi-person-plus-fill"></i> Agza bolmak
                    </button>
                </div>

                {{-- ================= ÝALŇYŞLYKLAR ================= --}}
                @if($errors->any())
                <div class="lm-errors" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- ================= FORMA ================= --}}
                <form id="authForm" action="{{ route('login.post') }}" method="POST" novalidate>
                    @csrf

                    <div class="lm-group d-none" id="nameBlock">
                        <label for="userNameInput" class="lm-label">Adyňyz</label>
                        <div class="lm-field">
                            <i class="bi bi-person lm-ico"></i>
                            <input type="text" name="name" id="userNameInput" value="{{ old('name') }}"
                                class="lm-input @error('name') is-invalid @enderror"
                                placeholder="Adyňyzy ýazyň" autocomplete="name">
                        </div>
                    </div>

                    <div class="lm-group">
                        <label for="userEmailInput" class="lm-label">E-mail</label>
                        <div class="lm-field">
                            <i class="bi bi-envelope lm-ico"></i>
                            <input type="email" name="email" id="userEmailInput" value="{{ old('email') }}" required
                                class="lm-input @error('email') is-invalid @enderror"
                                placeholder="E-mail poçtaňyz" autocomplete="email">
                        </div>
                    </div>

                    <div class="lm-group">
                        <label for="passwordInput" class="lm-label">Parol</label>
                        <div class="lm-field">
                            <i class="bi bi-lock lm-ico"></i>
                            <input type="password" name="password" id="passwordInput" required
                                class="lm-input pe-5 @error('password') is-invalid @enderror"
                                placeholder="Parolyňyz" autocomplete="current-password">
                            <i id="togglePassword" class="bi bi-eye lm-eye" role="button" tabindex="0" aria-label="Paroly görkez"></i>
                        </div>

                        <div class="lm-strength d-none" id="pwStrength">
                            <div class="lm-bars"><span></span><span></span><span></span><span></span></div>
                            <small id="pwStrengthText">Parolyň çylşyrymlylygy</small>
                        </div>
                    </div>

                    <div class="lm-group d-none" id="confirmPasswordBlock">
                        <label for="passwordConfirmInput" class="lm-label">Parol tassyklaň</label>
                        <div class="lm-field">
                            <i class="bi bi-shield-lock lm-ico"></i>
                            <input type="password" name="password_confirmation" id="passwordConfirmInput"
                                class="lm-input pe-5" placeholder="Paroly gaýtalaň" autocomplete="new-password">
                            <i id="toggleConfirmPassword" class="bi bi-eye lm-eye" role="button" tabindex="0" aria-label="Paroly görkez"></i>
                        </div>
                        <small class="lm-match d-none" id="pwMatch"></small>
                    </div>

                    <button type="submit" id="submitBtn" class="lm-submit login">
                        <span class="lm-submit-label">Girmek</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <p class="lm-switch" id="lmSwitch">
                    <span id="lmSwitchText">Heniz hasabyňyz ýokmy?</span>
                    <a href="#" id="lmSwitchLink">Agza boluň</a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* ---------- Modal çarçuwasy ---------- */
    .lm-dialog { max-width: 440px; }

    .lm-content {
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 28px;
        box-shadow: 0 30px 80px rgba(15, 23, 42, .35);
    }

    #loginModal.fade .modal-dialog { transform: translateY(30px) scale(.96); transition: transform .45s cubic-bezier(.16, 1, .3, 1), opacity .3s; }
    #loginModal.show .modal-dialog { transform: none; }

    .lm-close {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 5;
        opacity: .9;
        padding: .6rem;
        background-color: rgba(255, 255, 255, .15);
        border-radius: 50%;
        transition: transform .3s ease, background-color .2s;
    }

    .lm-close:hover { opacity: 1; background-color: rgba(255, 255, 255, .28); transform: rotate(90deg); }

    /* ---------- Baş bölek ---------- */
    .lm-hero {
        position: relative;
        overflow: hidden;
        padding: 1.75rem 1.5rem 3.4rem;
        text-align: center;
        background: linear-gradient(135deg, #0d6efd 0%, #0a4fc4 100%);
        color: #fff;
        transition: background .5s ease;
    }

    .lm-hero.is-register { background: linear-gradient(135deg, #22a06b 0%, #146c43 100%); }

    .lm-hero::before,
    .lm-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: #fff;
        pointer-events: none;
    }

    .lm-hero::before { width: 210px; height: 210px; right: -70px; top: -90px; opacity: .1; }
    .lm-hero::after  { width: 130px; height: 130px; left: -40px; bottom: -60px; opacity: .08; }

    .lm-hero > * { position: relative; z-index: 1; }

    .lm-hero-ico {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto .75rem;
        border-radius: 50%;
        background: rgba(255, 255, 255, .2);
        font-size: 1.7rem;
    }

    #loginModal.show .lm-hero-ico { animation: lmPop .7s .15s cubic-bezier(.34, 1.56, .64, 1) both; }

    @keyframes lmPop { from { opacity: 0; transform: scale(.4) rotate(-20deg); } to { opacity: 1; transform: none; } }

    .lm-logo {
        margin: 0;
        font-size: 1.85rem;
        font-weight: 900;
        letter-spacing: -.6px;
        line-height: 1.1;
    }

    .lm-logo span { color: #ffc2cc; }
    .lm-hero-sub { margin: .35rem 0 0; font-size: .92rem; font-weight: 600; opacity: .9; }

    /* ---------- Ýüzi ---------- */
    .lm-body {
        position: relative;
        margin-top: -1.9rem;
        padding: 0 1.5rem 1.5rem;
        border-radius: 24px 24px 0 0;
        background: #fff;
    }

    @media (min-width: 576px) { .lm-body { padding: 0 2rem 1.75rem; } }

    /* ---------- Tab syçan ---------- */
    .lm-tabs {
        position: relative;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 5px;
        margin: 0 0 1.25rem;
        transform: translateY(-50%);
        margin-bottom: -.4rem;
        border-radius: 50rem;
        background: #fff;
        box-shadow: 0 10px 26px rgba(15, 23, 42, .14);
    }

    .lm-indicator {
        position: absolute;
        top: 5px;
        bottom: 5px;
        left: 5px;
        width: calc(50% - 5px);
        border-radius: 50rem;
        background: linear-gradient(135deg, #dc3545, #b02a37);
        box-shadow: 0 6px 14px rgba(220, 53, 69, .35);
        transition: transform .4s cubic-bezier(.34, 1.3, .64, 1), background .4s ease, box-shadow .4s ease;
    }

    .lm-tabs[data-mode="register"] .lm-indicator {
        transform: translateX(100%);
        background: linear-gradient(135deg, #198754, #146c43);
        box-shadow: 0 6px 14px rgba(25, 135, 84, .35);
    }

    .lm-tab {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        padding: .7rem .5rem;
        border: 0;
        border-radius: 50rem;
        background: transparent;
        color: #64748b;
        font-size: .95rem;
        font-weight: 800;
        transition: color .3s ease;
    }

    .lm-tab.active { color: #fff; }

    /* ---------- Ýalňyşlyklar ---------- */
    .lm-errors {
        display: flex;
        gap: .6rem;
        margin: 1rem 0 .25rem;
        padding: .8rem 1rem;
        border: 1px solid #f8c9ce;
        border-radius: 14px;
        background: #fdecee;
        color: #b02a37;
        font-size: .88rem;
        font-weight: 700;
        animation: lmShake .5s ease;
    }

    .lm-errors i { margin-top: .1rem; }
    .lm-errors ul { margin: 0; padding-left: 1rem; }

    @keyframes lmShake {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-6px); }
        40% { transform: translateX(6px); }
        60% { transform: translateX(-4px); }
        80% { transform: translateX(4px); }
    }

    /* ---------- Meýdanlar ---------- */
    .lm-group { margin-top: 1rem; }
    .lm-group.lm-show { animation: lmDrop .4s cubic-bezier(.16, 1, .3, 1) both; }

    @keyframes lmDrop { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: none; } }

    .lm-label {
        display: block;
        margin-bottom: .35rem;
        font-size: .82rem;
        font-weight: 800;
        color: #475569;
    }

    .lm-field { position: relative; }

    .lm-ico {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.05rem;
        pointer-events: none;
        transition: color .2s;
    }

    .lm-input {
        width: 100%;
        padding: .8rem 1rem .8rem 2.8rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        background: #f8fafc;
        color: #0f172a;
        font-weight: 600;
        transition: all .25s ease;
    }

    .lm-input::placeholder { color: #a0aec0; font-weight: 500; }

    .lm-input:focus {
        outline: 0;
        background: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .lm-field:focus-within .lm-ico { color: #0d6efd; }
    .lm-input.is-invalid { border-color: #dc3545; background: #fff7f8; }

    .lm-eye {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        z-index: 10;
        color: #94a3b8;
        font-size: 1.2rem;
        cursor: pointer;
        transition: color .2s, transform .2s;
    }

    .lm-eye:hover { color: #0d6efd; transform: translateY(-50%) scale(1.15); }

    /* parol güýji */
    .lm-strength { display: flex; align-items: center; gap: .6rem; margin-top: .5rem; }
    .lm-bars { display: flex; flex: 1; gap: 4px; }
    .lm-bars span { flex: 1; height: 5px; border-radius: 4px; background: #e2e8f0; transition: background .3s ease; }
    .lm-strength small { min-width: 78px; font-size: .75rem; font-weight: 700; color: #64748b; text-align: right; }

    .lm-strength[data-level="1"] .lm-bars span:nth-child(-n+1) { background: #dc3545; }
    .lm-strength[data-level="2"] .lm-bars span:nth-child(-n+2) { background: #f59e0b; }
    .lm-strength[data-level="3"] .lm-bars span:nth-child(-n+3) { background: #84cc16; }
    .lm-strength[data-level="4"] .lm-bars span:nth-child(-n+4) { background: #198754; }

    .lm-match { display: block; margin-top: .4rem; font-size: .78rem; font-weight: 800; }
    .lm-match.ok { color: #198754; }
    .lm-match.no { color: #dc3545; }

    /* ---------- Ugratmak düwmesi ---------- */
    .lm-submit {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .6rem;
        width: 100%;
        margin-top: 1.5rem;
        padding: .95rem;
        border: 0;
        border-radius: 16px;
        color: #fff;
        font-size: 1.05rem;
        font-weight: 800;
        transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .lm-submit.login    { background: linear-gradient(135deg, #dc3545, #b02a37); box-shadow: 0 10px 24px rgba(220, 53, 69, .35); }
    .lm-submit.register { background: linear-gradient(135deg, #198754, #146c43); box-shadow: 0 10px 24px rgba(25, 135, 84, .35); }

    .lm-submit::after {
        content: "";
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .35), transparent);
        transform: skewX(-20deg);
        animation: lmShine 3.5s ease-in-out infinite;
    }

    @keyframes lmShine { 0%, 60% { left: -80%; } 100% { left: 140%; } }

    .lm-submit:hover:not(:disabled) { transform: translateY(-3px); color: #fff; }
    .lm-submit:active:not(:disabled) { transform: scale(.98); }
    .lm-submit:disabled { opacity: .8; cursor: wait; }
    .lm-submit i { transition: transform .25s; }
    .lm-submit:hover:not(:disabled) i { transform: translateX(5px); }

    .lm-spin { animation: lmSpin 1s linear infinite; }

    @keyframes lmSpin { to { transform: rotate(360deg); } }

    /* ---------- Aşakdaky çalyşmak ---------- */
    .lm-switch { margin: 1.1rem 0 0; text-align: center; font-size: .9rem; font-weight: 600; color: #64748b; }
    .lm-switch a { margin-left: .25rem; color: #0d6efd; font-weight: 800; text-decoration: none; }
    .lm-switch a:hover { text-decoration: underline; }

    @media (prefers-reduced-motion: reduce) {
        #loginModal.show .lm-hero-ico, .lm-group.lm-show, .lm-errors, .lm-submit::after { animation: none !important; }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabGirmek = document.getElementById('tabGirmek');
        const tabAgza = document.getElementById('tabAgza');
        const tabs = document.getElementById('lmTabs');
        const hero = document.querySelector('.lm-hero');
        const heroIcon = document.getElementById('lmHeroIcon');
        const subtitle = document.getElementById('lmSubtitle');

        const nameBlock = document.getElementById('nameBlock');
        const userNameInput = document.getElementById('userNameInput');
        const confirmPasswordBlock = document.getElementById('confirmPasswordBlock');
        const confirmPasswordInput = document.getElementById('passwordConfirmInput');
        const passwordInput = document.getElementById('passwordInput');
        const strengthBox = document.getElementById('pwStrength');
        const strengthText = document.getElementById('pwStrengthText');
        const matchEl = document.getElementById('pwMatch');

        const authForm = document.getElementById('authForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitLabel = submitBtn.querySelector('.lm-submit-label');
        const switchText = document.getElementById('lmSwitchText');
        const switchLink = document.getElementById('lmSwitchLink');

        const LOGIN_URL = "{{ route('login.post') }}";
        const REGISTER_URL = "{{ route('register') }}";

        function reveal(el) {
            el.classList.remove('d-none', 'lm-show');
            void el.offsetWidth;
            el.classList.add('lm-show');
        }

        /* ---------- Girmek / Agza bolmak çalyşmak ---------- */
        function setMode(mode) {
            const reg = mode === 'register';

            tabs.dataset.mode = mode;
            tabGirmek.classList.toggle('active', !reg);
            tabAgza.classList.toggle('active', reg);
            hero.classList.toggle('is-register', reg);
            heroIcon.className = 'bi ' + (reg ? 'bi-person-plus-fill' : 'bi-person-fill');
            subtitle.textContent = reg ? 'Täze hasap dörediň, bir minut ýeterlik' : 'Hasabyňyza giriň we söwda ediň';

            if (reg) {
                reveal(nameBlock);
                reveal(confirmPasswordBlock);
                strengthBox.classList.remove('d-none');
                userNameInput.required = true;
                confirmPasswordInput.required = true;
            } else {
                nameBlock.classList.add('d-none');
                confirmPasswordBlock.classList.add('d-none');
                strengthBox.classList.add('d-none');
                matchEl.classList.add('d-none');
                userNameInput.required = false;
                confirmPasswordInput.required = false;
            }

            passwordInput.autocomplete = reg ? 'new-password' : 'current-password';

            submitLabel.textContent = reg ? 'Agza bolmak' : 'Girmek';
            submitBtn.classList.toggle('login', !reg);
            submitBtn.classList.toggle('register', reg);

            switchText.textContent = reg ? 'Eýýäm hasabyňyz barmy?' : 'Heniz hasabyňyz ýokmy?';
            switchLink.textContent = reg ? 'Giriň' : 'Agza boluň';

            authForm.action = reg ? REGISTER_URL : LOGIN_URL;
        }

        tabGirmek.addEventListener('click', e => { e.preventDefault(); setMode('login'); });
        tabAgza.addEventListener('click', e => { e.preventDefault(); setMode('register'); });
        switchLink.addEventListener('click', e => {
            e.preventDefault();
            setMode(tabs.dataset.mode === 'register' ? 'login' : 'register');
        });

        function bindToggle(iconId, inputId) {
            const icon = document.getElementById(iconId);
            const input = document.getElementById(inputId);
            if (!icon || !input) return;

            function toggle(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !show);
                icon.classList.toggle('bi-eye-slash', show);
            }

            icon.addEventListener('click', toggle);
            icon.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { toggle(e); } });
        }

        bindToggle('togglePassword', 'passwordInput');
        bindToggle('toggleConfirmPassword', 'passwordConfirmInput');

        const levels = ['Gaty gowşak', 'Gowşak', 'Orta', 'Güýçli', 'Örän güýçli'];

        function checkStrength() {
            const v = passwordInput.value;
            let score = 0;
            if (v.length >= 8) score++;
            if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
            if (/\d/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) score++;
            if (!v) score = 0;

            strengthBox.dataset.level = score;
            strengthText.textContent = v ? levels[Math.max(score, 0)] : 'Parolyň çylşyrymlylygy';
        }

        function checkMatch() {
            if (tabs.dataset.mode !== 'register' || !confirmPasswordInput.value) {
                matchEl.classList.add('d-none');
                return;
            }

            const ok = passwordInput.value === confirmPasswordInput.value;
            matchEl.classList.remove('d-none', 'ok', 'no');
            matchEl.classList.add(ok ? 'ok' : 'no');
            matchEl.textContent = ok ? '✓ Parollar gabat gelýär' : 'Parollar gabat gelmeýär';
        }

        passwordInput.addEventListener('input', () => { checkStrength(); checkMatch(); });
        confirmPasswordInput.addEventListener('input', checkMatch);

        authForm.addEventListener('input', e => e.target.classList?.remove('is-invalid'));

        authForm.addEventListener('submit', function (e) {
            if (tabs.dataset.mode === 'login') {
                userNameInput.required = false;
                confirmPasswordInput.required = false;
            }

            if (!authForm.checkValidity()) {
                e.preventDefault();
                authForm.reportValidity();
                return;
            }

            if (tabs.dataset.mode === 'register' && passwordInput.value !== confirmPasswordInput.value) {
                e.preventDefault();
                confirmPasswordInput.classList.add('is-invalid');
                confirmPasswordInput.focus();
                checkMatch();
                return;
            }

            submitBtn.disabled = true;
            submitLabel.textContent = 'Garaşyň...';
            const iconEl = submitBtn.querySelector('i');
            if (iconEl) iconEl.className = 'bi bi-arrow-repeat lm-spin';
        });

        setMode( $lmStartRegister ? "'register'" : "'login'" );

        /* ---------- Modal ýapylanda arassalamak ---------- */
        var loginModalEl = document.getElementById('loginModal');
        if (loginModalEl) {
            loginModalEl.addEventListener('hidden.bs.modal', function () {
                document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        }
    });
</script>

@guest
@if(session('openLoginModal') || request()->has('openLogin') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalElement = document.getElementById('loginModal');
        if (modalElement && typeof bootstrap !== 'undefined') {
            var loginModal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            loginModal.show();
        }
    });
</script>
@endif
@endguest