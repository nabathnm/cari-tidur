<x-guest-layout>
    <x-slot name="title">Masuk</x-slot>

    {{-- ── Inline styles: scoped to this view only ── --}}
    <style>
        /* Import Plus Jakarta Sans from Google Fonts CDN */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        .kos-login-wrap * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }

        /* Brand header */
        .kos-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .kos-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(22,163,74,0.30);
        }
        .kos-brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #15803d;
            letter-spacing: -0.3px;
        }

        /* Heading */
        .kos-heading { margin-bottom: 28px; }
        .kos-heading h2 {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.4px;
            margin: 0 0 6px;
        }
        .kos-heading p {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        /* Field labels */
        .kos-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            letter-spacing: 0.1px;
        }

        /* Text inputs */
        .kos-input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            background: #f9fafb;
            font-size: 14px;
            color: #111827;
            outline: none;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }
        .kos-input::placeholder { color: #9ca3af; }
        .kos-input:focus {
            border-color: #16a34a;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.12);
        }
        .kos-input--error {
            border-color: #f87171 !important;
            background: #fff5f5 !important;
        }
        .kos-input-wrap {
            position: relative;
        }
        .kos-input-icon {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            width: 18px;
            height: 18px;
        }
        .kos-input-icon--toggle {
            pointer-events: auto;
            cursor: pointer;
            transition: color .15s;
        }
        .kos-input-icon--toggle:hover { color: #16a34a; }
        .kos-input--with-icon { padding-right: 40px; }

        /* Error message */
        .kos-error { color: #ef4444; font-size: 12px; margin-top: 5px; display: flex; align-items: center; gap: 4px; }

        /* Form group spacing */
        .kos-field { margin-bottom: 18px; }

        /* Password row */
        .kos-pw-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }
        .kos-forgot {
            font-size: 12px;
            font-weight: 600;
            color: #16a34a;
            text-decoration: none;
            transition: color .15s;
        }
        .kos-forgot:hover { color: #15803d; }

        /* Remember me */
        .kos-remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
        }
        .kos-remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 5px;
            border: 1.5px solid #d1d5db;
            appearance: none;
            -webkit-appearance: none;
            background: #f9fafb;
            cursor: pointer;
            position: relative;
            transition: border-color .15s, background .15s;
            flex-shrink: 0;
        }
        .kos-remember input[type="checkbox"]:checked {
            background: #16a34a;
            border-color: #16a34a;
        }
        .kos-remember input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 1.5px;
            width: 5px;
            height: 9px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }
        .kos-remember label {
            font-size: 13px;
            color: #4b5563;
            cursor: pointer;
            font-weight: 500;
        }

        /* Primary button */
        .kos-btn-primary {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, opacity .15s;
            box-shadow: 0 4px 14px rgba(22,163,74,0.35);
            letter-spacing: 0.1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .kos-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(22,163,74,0.40);
        }
        .kos-btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(22,163,74,0.30);
        }

        /* Divider */
        .kos-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 4px 0 20px;
        }
        .kos-divider::before,
        .kos-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
        .kos-divider span {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Secondary / outline button */
        .kos-btn-secondary {
            width: 100%;
            padding: 11px 20px;
            background: transparent;
            color: #15803d;
            font-size: 14px;
            font-weight: 600;
            border: 1.5px solid #bbf7d0;
            border-radius: 12px;
            cursor: pointer;
            transition: border-color .18s, background .18s, color .18s, transform .15s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .kos-btn-secondary:hover {
            border-color: #16a34a;
            background: #f0fdf4;
            color: #15803d;
            transform: translateY(-1px);
        }

        /* Session status */
        .kos-status {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            color: #15803d;
            font-weight: 500;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Decorative dots top-right */
        .kos-deco {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 80px;
            height: 80px;
            background-image: radial-gradient(circle, #bbf7d0 1.5px, transparent 1.5px);
            background-size: 12px 12px;
            opacity: 0.6;
            pointer-events: none;
            border-radius: 0 16px 0 0;
            z-index: 0;
        }
    </style>

    <div class="kos-login-wrap" style="position: relative;">
        {{-- Decorative dots --}}
        <div class="kos-deco" aria-hidden="true"></div>

        {{-- Brand --}}
        <div class="kos-brand">
            <div class="kos-brand-icon">
                {{-- Home/kosan icon --}}
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="kos-brand-name">KosanKu</span>
        </div>

        {{-- Heading --}}
        <div class="kos-heading">
            <h2>Selamat datang kembali 👋</h2>
            <p>Masuk untuk melanjutkan ke akun Anda.</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="kos-status">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="kos-field">
                <label for="email" class="kos-label">Alamat Email</label>
                <div class="kos-input-wrap">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           placeholder="nama@email.com"
                           class="kos-input kos-input--with-icon {{ $errors->has('email') ? 'kos-input--error' : '' }}">
                    <svg class="kos-input-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                @error('email')
                    <p class="kos-error">
                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="kos-field">
                <div class="kos-pw-row">
                    <label for="password" class="kos-label" style="margin-bottom:0;">Password</label>
                </div>
                <div class="kos-input-wrap">
                    <input id="password" type="password" name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••"
                           class="kos-input kos-input--with-icon {{ $errors->has('password') ? 'kos-input--error' : '' }}">
                    {{-- Toggle show/hide --}}
                    <svg id="pw-eye" class="kos-input-icon kos-input-icon--toggle"
                         onclick="togglePw()"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"
                         title="Tampilkan password">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                @error('password')
                    <p class="kos-error">
                        <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="kos-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya selama 30 hari</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="kos-btn-primary">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk ke Akun
            </button>
        </form>

        {{-- Divider --}}
        <div class="kos-divider">
            <span>Belum punya akun?</span>
        </div>

        {{-- Register link --}}
        <a href="{{ route('register') }}" class="kos-btn-secondary">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Daftar Akun Baru
        </a>
    </div>

    <script>
        function togglePw() {
            const input = document.getElementById('password');
            const eye   = document.getElementById('pw-eye');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            // Swap icon between eye and eye-off
            eye.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round"
                         d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7
                            a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243
                            M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29
                            m7.532 7.532l3.29 3.29M3 3l3.59 3.59
                            m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7
                            a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round"
                         d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                   <path stroke-linecap="round" stroke-linejoin="round"
                         d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    </script>
</x-guest-layout>