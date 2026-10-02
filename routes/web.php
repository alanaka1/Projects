<?php

use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('dashboard', function () {
    return view('Projects.Dashboard.index');
    // return view('Projects.Dashboard.test.form');
});


Route::get('admin/login', function () {
    return view('Projects.Auth.login');
    // return view('Projects.Auth.register');
    // return view('Projects.Auth.forgot-password');
});