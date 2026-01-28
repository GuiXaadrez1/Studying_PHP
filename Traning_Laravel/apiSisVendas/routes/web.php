<?php

use Illuminate\Support\Facades\Route;


# importando as models para a nossa API
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('adm')->group(function(){

    Route::GET('/listAdms',[AdminController::class,'index'])->name('listAdms.index');

    // where(), vai colcoar uma condicao no parâmetro da url com regex
    Route::GET('/infoAdm/{id}',[AdminController::class,'show'])->where('id','[0-9]+')->name('infoAdm.show');

});