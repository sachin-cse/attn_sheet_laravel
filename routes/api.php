<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
Route::prefix('api')->name('api.')->group(function(){
    Route::post('/user/register',[AuthApiController::class,'UserRegisterApi'])->name('user_register_api');
});