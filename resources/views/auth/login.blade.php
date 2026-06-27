@extends('layouts.guest')

@section('body-class', 'login-page')
@section('wrapper-class', 'login-page__wrapper')

@section('content')
    <div class="col-12 col-xl-10 col-xxl-8">
        <div class="login-card">
            <div class="login-card__visual bg-login-image">
                <div class="login-card__overlay">
                    <div class="login-card__brand">
                        <div class="login-card__brand-icon">
                            <i class='bx bx-package'></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-card__form">
                <div class="login-card__form-inner">
                    <div class="login-card__header">
                        <h1>{{ __('Login') }}</h1>
                        <p>Masuk ke akun Anda untuk melanjutkan</p>
                    </div>

                    @include('layouts.includes.errors')

                    <form action="{{ route('login') }}" method="POST" class="login-form">
                        @csrf

                        <div class="login-field mb-3">
                            <label class="login-field__label" for="email">{{ __('Username') }}</label>
                            <div class="login-field__input @error('username') is-invalid-group @enderror">
                                <i class='bx bx-user'></i>
                                <input
                                    id="email"
                                    class="form-control @error('username') is-invalid @enderror"
                                    type="text"
                                    name="email"
                                    placeholder="Masukkan username"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus>
                            </div>
                            @error('username')
                                <div class="login-field__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-field mb-4">
                            <label class="login-field__label" for="password">{{ __('Password') }}</label>
                            <div class="login-field__input @error('password') is-invalid-group @enderror">
                                <i class='bx bx-lock-alt'></i>
                                <input
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    type="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    required>
                            </div>
                            @error('password')
                                <div class="login-field__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary login-btn w-100" type="submit">
                            <span>{{ __('Login') }}</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
