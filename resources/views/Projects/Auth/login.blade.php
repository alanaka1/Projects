@extends('Projects.Auth.layout.app')

@section('title', __('Auth/login.view.title').' - AdminPro')

@section('css')
@endsection

@section('content')
<!-- Login Card -->
<section class="auth-card">

    {{-- اختيار اللغة --}}
    <div class="d-flex justify-content-end px-4 pt-3">
        <div class="dropdown">
            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-globe me-1"></i>
                {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item {//{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{//{ route('language.switch', 'ar') }}">العربية</a></li>
                <li><a class="dropdown-item {//{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{//{ route('language.switch', 'en') }}">English</a></li>
            </ul>
        </div>
    </div>

    <div class="auth-card-header">
        <h1>@lang('Auth/login.view.welcome_back')</h1>
        <p>@lang('Auth/login.view.sign_in_description')</p>
    </div>

    <div class="auth-card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form id="loginForm" action="{{ route('login.store') }}" method="POST">
            @csrf

            <!-- Email or Username -->
            <div class="mb-3">
                <label for="login" class="form-label">@lang('Auth/login.view.login')</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">
                        <i class="fa-regular fa-envelope"></i>
                    </span>
                    <input type="text" class="form-control form-control-sm @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" placeholder="@lang('Auth/login.view.login_placeholder')" autocomplete="username" required>
                </div>
                @error('login')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Password -->
            <div class="mb-2">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <label for="password" class="form-label mb-0">@lang('Auth/login.view.password')</label>
                    <a href="{{ \Illuminate\Support\Facades\Route::has('password.request') ? route('password.request') : url('forgot-password.html') }}" class="auth-link">@lang('Auth/login.view.forgot_password')</a>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="@lang('Auth/login.view.password_placeholder')" autocomplete="current-password" required>

                    <button type="button" class="password-toggle" data-password-toggle="password" title="@lang('Auth/login.view.show_password')" aria-label="@lang('Auth/login.view.show_password')">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Remember -->
            <div class="form-check auth-remember">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1" @checked(old('remember'))>
                <label class="form-check-label" for="remember">@lang('Auth/login.view.remember')</label>
            </div>
            @error('remember')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

            <!-- Submit -->
            <button type="submit" class="btn btn-primary btn-sm auth-submit w-100">
                <i class="fa-solid fa-right-to-bracket auth-btn-icon"></i>
                <span>@lang('Auth/login.view.submit')</span>
            </button>
        </form>
    </div>

    <!-- Footer -->
    <div class="auth-card-footer">
        <span>@lang('Auth/login.view.no_account')</span>
        <a href="{{ \Illuminate\Support\Facades\Route::has('register') ? route('register') : url('register.html') }}" class="auth-link">@lang('Auth/login.view.create_account')</a>
    </div>
</section>
@endsection

@section('javascript')
@endsection