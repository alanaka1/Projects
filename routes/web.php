<?php

use App\Http\Controllers\Projects\Auth\{UserController, RoleController, LoginController};
use Illuminate\Support\Facades\{Route, Auth};

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // تبديل اللغة للجميع.
// Route::get('language/{locale}', function (string $locale) {
//     abort_unless(in_array($locale, ['ar', 'en'], true), 404);

//     session()->put('locale', $locale);

//     return back();
// })->name('language.switch');

// تسجيل الدخول للزوار.
Route::group(['middleware' => 'guest', 'controller' => LoginController::class], function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('login.store');
});

// تسجيل الخروج دون اشتراط صلاحية.
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// الصفحات المحمية بالمصادقة والصلاحيات.
Route::group(['middleware' => ['auth', 'role']], function () {

    Route::group(['controller' => LoginController::class], function () {
        Route::get('dashboard', ['uses' => 'index','roles' => 'dashboard.index',])->name('dashboard');
    });
    
    Route::group(['prefix' => 'users', 'as' => 'users.', 'controller' => UserController::class,], function () {
        Route::get('/', ['uses' => 'index','roles' => 'users.index',])->name('index');
        Route::get('create', ['uses' => 'create','roles' => 'users.create',])->name('create');
        Route::get('trash', ['uses' => 'trash','roles' => 'users.trash',])->name('trash');
        Route::post('store', ['uses' => 'store','roles' => 'users.create',])->name('store');
        Route::get('{user}', ['uses' => 'show','roles' => 'users.show',])->name('show');
        Route::get('{user}/roles', ['uses' => 'role','roles' => 'users.role',])->name('role');
        Route::get('{user}/edit', ['uses' => 'edit','roles' => 'users.edit',])->name('edit');
        Route::put('{user}/update', ['uses' => 'update','roles' => 'users.edit',])->name('update');
        Route::patch('{user}/status', ['uses' => 'updateStatus','roles' => 'users.status',])->name('status');
        Route::delete('{user}/destroy', ['uses' => 'destroy','roles' => 'users.delete',])->name('destroy');
        Route::post('{id}/restore', ['uses' => 'restore','roles' => 'users.restore',])->name('restore');
        Route::delete('{id}/force-destroy', ['uses' => 'forceDestroy','roles' => 'users.force-delete',])->name('force-destroy');
        Route::patch('{user}/roles', ['uses' => 'updateRole','roles' => 'admin',])->name('roles.update');
        Route::delete('{user}/remove-image', ['uses' => 'removeImage','roles' => 'users.remove-image',])->name('remove-image');
    });
    
    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'controller' => RoleController::class,], function () {
        Route::get('/', ['uses' => 'index','roles' => 'roles.index',])->name('index');
        Route::get('create', ['uses' => 'create','roles' => 'roles.create',])->name('create');
        Route::get('trash', ['uses' => 'trash','roles' => 'roles.trash',])->name('trash');
        Route::post('store', ['uses' => 'store','roles' => 'roles.create',])->name('store');
        Route::get('{role}', ['uses' => 'show','roles' => 'roles.show',])->name('show');
        Route::get('{role}/edit', ['uses' => 'edit','roles' => 'roles.edit',])->name('edit');
        Route::put('{role}/update', ['uses' => 'update','roles' => 'roles.edit',])->name('update');
        Route::patch('{role}/status', ['uses' => 'updateStatus','roles' => 'roles.status',])->name('status');
        Route::delete('{role}/destroy', ['uses' => 'destroy','roles' => 'roles.delete',])->name('destroy');
        Route::post('{id}/restore', ['uses' => 'restore','roles' => 'roles.restore',])->name('restore');
        Route::delete('{id}/force-destroy', ['uses' => 'forceDestroy','roles' => 'roles.force-delete',])->name('force-destroy');
    });

});