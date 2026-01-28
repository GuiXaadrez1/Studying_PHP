<?php

use Illuminate\Support\Facades\Route;


# importando as controllers para a nossa API
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'store']);

// criando nossas rotas protegidas com o meddleware correto
Route::middleware('auth:admin')->prefix('adm')->group(function(){

    Route::get('/listAdms', [AdminController::class, 'index']);

    // where serve para colocarmos condições a serem atendidas
    // com regex... ou seja, esse id, deve ser um número
    Route::get('/infoAdm/{id}', [AdminController::class, 'show'])
        ->where('id', '[0-9]+');
    
    // rota para logout, preciso estar autenticado para deslogar
    Route::post('/logout',[LoginController::class, 'logout']);
});