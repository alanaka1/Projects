<?php

namespace App\Http\Controllers\Projects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Projects.Dashboard.index');
    }

    /**
     * Show the form for creating a new resource. عرض نموذج تسجيل الدخول.
     */
    public function create()
    {
        return view('Projects.Auth.login');
    }

    /**
     * Store a newly created resource in storage. تسجيل الدخول بالبريد الإلكتروني أو اسم المستخدم.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'login'    => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ], [
            'login.required'    => __('Auth/login.validation.login_required'),
            'login.string'      => __('Auth/login.validation.login_string'),
            'login.max'         => __('Auth/login.validation.login_max'),
            'password.required' => __('Auth/login.validation.password_required'),
            'password.string'   => __('Auth/login.validation.password_string'),
            'remember.boolean'  => __('Auth/login.validation.remember_boolean'),
        ]);

        $login = trim($data['login']);
        $throttleKey = hash('sha256', Str::lower($login).'|'.$request->ip());

        // السماح بخمس محاولات فاشلة خلال دقيقة.
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'login' => __('Auth/login.controller.too_many_attempts', [
                    'seconds' => RateLimiter::availableIn($throttleKey),
                ]),
            ]);
        }

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $field     => $login,
            'password' => $data['password'],
            'status'   => 1,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages(['login' => __('Auth/login.controller.login_failed'),]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with(['success' => __('Auth/login.controller.logged_in_successfully'),]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage. تسجيل الخروج.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with(['success' => __('Auth/login.controller.logged_out_successfully'),]);
    }
}
