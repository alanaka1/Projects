<?php

use App\Http\Controllers\Projects\Auth\UserController;
use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('dashboard', function () {
    return view('Projects.Dashboard.index');
    // return view('Projects.Dashboard.test.form');
})->name('dashboard');


Route::get('admin/login', function () {
    return view('Projects.Auth.login');
    // return view('Projects.Auth.register');
    // return view('Projects.Auth.forgot-password');
});


Route::group(['prefix' => 'users', 'as' => 'users.', 'controller' => UserController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('trash', 'trash')->name('trash');
    Route::get('{user}', 'show')->name('show');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::put('{user}/update', 'update')->name('update');
    Route::patch('{user}/status', 'updateStatus')->name('status');
    Route::delete('{user}/destroy', 'destroy')->name('destroy');
    Route::post('{id}/restore', 'restore')->name('restore');
    Route::delete('{id}/force-destroy', 'forceDestroy')->name('force-destroy');
    Route::delete('{user}/remove-image', 'removeImage')->name('remove-image');
});