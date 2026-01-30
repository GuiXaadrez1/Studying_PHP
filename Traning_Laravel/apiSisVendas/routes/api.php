<?php

use Illuminate\Support\Facades\Route;


# importando as controllers para a nossa API
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('admin/login', [LoginController::class, 'store'])->name('admin.login');

// criando nossas rotas protegidas com o meddleware correto

// Route::middleware('auth:admin')->prefix('adm')->group(function(){

// essa forma deixa explícito que estamos usando qual midewlere estamos usando
//Route::middleware(['auth:sanctum'])->prefix('adm')->group(function(){

Route::middleware('auth:admin')->prefix('adm')->group(function(){

    // no front-end pode ser criada um tabela com as informacoes básica dos adms 
    Route::get('/listAdms', [AdminController::class, 'index'])->name('admin.index');

    // where serve para colocarmos condições a serem atendidas
    // com regex... ou seja, esse id, deve ser um número
    // no front-end ao clicar na opcao atualizar pode redirecionar para 
    // esse rota, vamo obter as informaçoes especpificas do perfil do adm...
    Route::get('profile/infoAdm/{id}', [AdminController::class, 'show'])
        ->where('id', '[0-9]+')->name('admin.info');
    
    // Rota que insere um administrador no banco de dados
    Route::post('/addAdmin',[AdminController::class,'store'])->name('admin.add');

    // Rota que atualiza as informações do administrador
    Route::put('/updateAdmin/{id}',[AdminController::class,'update'])
    ->where('id','[0-9]+')->name('admin.update');

    // Rota de delecao lógica do administrador
    Route::put('/adminDelete/{id}',[AdminController::class,'destroy'])
    ->where('id','[0-9]+')->name('admin.deleted');

    // rota para logout, preciso estar autenticado para deslogar
    Route::post('/logout',[LoginController::class, 'logout'])->name('admin.logout');

});