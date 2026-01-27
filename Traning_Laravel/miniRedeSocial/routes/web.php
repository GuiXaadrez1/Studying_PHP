<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

/*
    No laravel antigo existia dois arquivos:
    api.php -> esse era usado para rotas de APIs na arquitetura REST API
    web.php -> esse era usado para rotas de views, paginas web normais, arquitetura server side rendering

    Atualmente, para simplificar, todas as rotas estão sendo definidas no arquivo web.php,
    mesmo as rotas de APIs na arquitetura REST API.
    Isso é possivel porque o laravel é muito flexivel e permite essa configuração.
    Claro que em projetos maiores, é recomendavel separar as rotas em arquivos diferentes
    para melhor organização e manutenção do código.

*/

Route::get('/', function () {
    // home.home, o primeiro home é a pasta o segundo é a pasta blade
    return view('home.home'); // perceba que ele retorna um html renderizado pelo servidor
})->name('home');

// Usamos o método prefix para colocar uma url prefixa a na nossa rota
// basicamente fixamos uma parte da rota
// depois agrupamos com as rotas definidas na funcao anonima (clousure)
// fica assim: login + / => /login/ ou /login
// ou login + /logout => login/logout

Route::prefix('/login')->group(function(){

    Route::post('/',[LoginController::class,'login'])->name('user.login');

    Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');

});

// usando middleware padrao do laravel para proteger rotas!

Route::middleware('auth')->group(
    function(){
        // estamos protegendo essa rota, caso seja acessada sem o login
        // ess forna com uma funcao anonima é a padrao do laravel
        // Route::get('/dashboard',function(){})->name('dashboard');
    
        Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    }
);


Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::middleware('auth')->prefix('user')->group(
    function(){
        // definido rota, endpoint da API na arquitetura REST API, nao estamos trabalhando
        // apenas com views, mas sim com controllers
        // lembrando que o metodo name() nomeia uma rota em específo para ser utilizado
        // em diversas outras partes do projeto, como envido de dados, redirecionamento
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::put('/',[UserController::class, 'update'])->name('user.update');
        // faz basicamente a mesma coisa do put
        Route::patch('/password',[UserController::class, 'updatePassword'])->name('user.update.password');
        Route::patch('/photo',[UserController::class, 'updatePhoto'])->name('user.update.hoto');
    }
);