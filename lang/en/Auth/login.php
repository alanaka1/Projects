<?php

return [
    'view' => [
        'title'    => 'Log In',
        'login'    => 'Email or Username',
        'password' => 'Password',
        'remember' => 'Remember Me',
        'submit'   => 'Log In',
        'logout'   => 'Log Out',
        'welcome_back'         => 'Welcome Back',
        'sign_in_description'  => 'Sign in to continue to your dashboard',
        'login_placeholder'    => 'Enter email or username',
        'forgot_password'      => 'Forgot Password?',
        'password_placeholder' => 'Enter password',
        'show_password'        => 'Show Password',
        'no_account'           => 'Don’t have an account?',
        'create_account'       => 'Create Account',
    ],

    'controller' => [
        'login_failed'            => 'The login details are incorrect or the account is unavailable.',
        'too_many_attempts'       => 'Too many login attempts. Please try again in :seconds seconds.',
        'logged_in_successfully'  => 'Logged in successfully.',
        'logged_out_successfully' => 'Logged out successfully.',
    ],

    'validation' => [
        'login_required'    => 'Email or username is required.',
        'login_string'      => 'Email or username must be a string.',
        'login_max'         => 'Email or username must not exceed 255 characters.',
        'password_required' => 'Password is required.',
        'password_string'   => 'Password must be a string.',
        'remember_boolean'  => 'The remember me value is invalid.',
    ],
];