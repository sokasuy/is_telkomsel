<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SPBController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');

    //PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('EnsureSalesAccess')->group(function () {
        //SPB
        Route::get('/sales/spb', [SPBController::class, 'index'])->name('spb.index')->middleware('EnsureUserHasPermission:sales,spb,read');
        Route::post('/sales/spb/show', [SPBController::class, 'show'])->name('spb.show');
        Route::get('/sales/spb/create', [SPBController::class, 'create'])->name('spb.create')->middleware('EnsureUserHasPermission:sales,spb,create');
        Route::get('/sales/spb/edit', [SPBController::class, 'edit'])->name('spb.edit')->middleware('EnsureUserHasPermission:sales,spb,update');
    });

    Route::middleware('EnsureAuthenticationAccess')->group(function () {
        //AUTHENTICATION FORMS
        Route::get('/authentication/users', [UserController::class, 'index'])->name('users.index')->middleware('EnsureUserHasPermission:authentication,users,read');
        Route::post('/authentication/users/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/authentication/users/create', [UserController::class, 'create'])->name('users.create')->middleware('EnsureUserHasPermission:authentication,users,create');
        Route::post('/authentication/users/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/authentication/users/edit-password', [UserController::class, 'editPassword'])->name('users.editpassword')->middleware('EnsureUserHasPermission:authentication,users,update');
        Route::post('/authentication/users/update-password', [UserController::class, 'updatePassword'])->name('users.updatepassword');
        Route::post('/authentication/users/edit-role', [UserController::class, 'editRole'])->name('users.editrole')->middleware('EnsureUserHasPermission:authentication,users,update');
        Route::post('/authentication/users/update-role', [UserController::class, 'updateRole'])->name('users.updaterole');

        //ROLES
        Route::get('/authentication/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('EnsureUserHasPermission:authentication,roles,read');
        Route::post('/authentication/roles/show', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/authentication/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('EnsureUserHasPermission:authentication,roles,create');
        Route::post('/authentication/roles/store', [RoleController::class, 'store'])->name('roles.store');

        //PERMISSION
        Route::get('/authentication/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('EnsureUserHasPermission:authentication,permission,read');
        Route::post('/authentication/permissions/show', [PermissionController::class, 'show'])->name('permissions.show');
        Route::post('/authentication/permissions/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('EnsureUserHasPermission:authentication,permission,update');
        Route::post('/authentication/permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
        Route::get('/authentication/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('EnsureUserHasPermission:authentication,permission,create');
        Route::post('/authentication/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    });
});

require __DIR__ . '/auth.php';
