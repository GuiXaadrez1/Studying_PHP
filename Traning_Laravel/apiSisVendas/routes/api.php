<?php

use Illuminate\Support\Facades\Route;


# importando as models para a nossa API
use App\Http\Controllers\AdminController;


Route::prefix('adm')->group(function(){

    Route::GET('/listAdms',[AdminController::class,'index'])->name('listAdms.index');
    Route::GET('/infoAdm',[AdminController::class,'show'])->name('infoAdm.show');

});
