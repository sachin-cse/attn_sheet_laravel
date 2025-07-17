<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendenceSheetController;


Route::prefix('attn')->group(function(){
    Route::get('/sheet', [AttendenceSheetController::class, 'attendence'])->name('attn.sheet');
    Route::post('/filter', [AttendenceSheetController::class, 'filterByMonthYear'])->name('attn.filter');
    Route::post('/mark', [AttendenceSheetController::class, 'markAttendence'])->name('attn.mark');
});
require __DIR__.'/api.php';
require __DIR__.'/auth.php';

