<?php
use App\Http\Controllers\AuthController;




Route::middleware("auth")->group(function()
{
    Route::view(uri:"/dash",view:"welcome")->name(name:"home");
    


});
Route::get('/login', [AuthController::class, 'login'])->name('login');


Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/', [AuthController::class, 'register'])->name('register');
Route::post('/', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


