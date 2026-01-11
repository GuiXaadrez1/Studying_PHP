<?php

use Illuminate\Support\Facades\Route;

# chamando a nossa class controller Criada, para podermos usar suas funcoes
use App\Http\Controllers\GameController;

# Lembrando que devemos colocar as rotas dentro do arquivo api.php
# da seguinte forma: 127.0.0.1/8000:api/ping
Route::get('/ping',
    
    // Funcao callback, anonimo ou clousere
    function(){
        # Retorna uma resposta com status 200 com a informacao'pong'
        # Aqui estamos usando o conceito de encadeamento de metodos (method chaining)
        return response()->json('pong');
    }
);


/*
    A funcao prefix('prefixo_url') do Router serve para aplicar um prefixo estática
    na nossa url

    a funcao group($callback) do Router serve para agrupar o prefixo com a url setada 
    para a nossa api ao qual rescebe verbi http para enviar uma resposta.

    isso evita ficar replicando prefixos em varias instancias de url

*/

/**
 * Essa é uma forma bem complexa de instanciar nossa controller afim de ser 
 * usada na nossa API!
 */
Route::prefix('gameExemplo1')->group(function(){
    
    Route::get('/game',function(){
        $controller = new GameController();
        return $controller->index();
    });
});


/*
    Este é um jeito bem mais fácil de realizar a mesma coisa acima
*/
Route::prefix('games')->group(function(){
    /*
        Aqui basicamente estamos fazendo o seguinte
        Com o operador Scope Resolution Operator (::)
        Estamos acessando itens da class, como metodos, mesmbros estaticos, constantes
        Neste caso, basicamente estamos acessando o caminho da class 
        pegando o metodo index...

        Isso: [GameController::class, 'index']

        Basicamente faz isso = Callable Syntax (Sintaxe de Chamada).

            $calc = new Calculadora();
            $minhaFuncao = [$calc, 'somar']; // Isso é um callable

        
            transforma um array que rescebe o objeto e a string que representa o nome da do seu metodo
            em uma funcao anonima

        O Laravel usa o array não apenas por organização, mas porque o PHP permite tratar esse 
        formato como se fosse uma função.

        O PHP entende que um array com dois elementos (um objeto e uma string) representa um 
        método de uma classe.

    */
    Route::get('/', [GameController::class, 'index'])->name('games.index');

    // Criando uma url dinâmica, passando parametros para a nossa url
    Route::get('/{id}', [GameController::class, 'show'])->name('games.show');

    /*
        a funcao name(Route named) nomeia uma rota criada
        Basicamente: Ela cria um "apelido" (alias) para a rota, o que desvincula o seu código da 
        URL física.

        Sem o name(), se você quiser mudar a URL de /games para /meus-jogos-favoritos, você 
        teria que procurar em todo o seu projeto (controllers, testes, arquivos Vue/React) 
        onde escreveu /games e mudar manualmente.
        Com o name('games.index'), você muda a URL no arquivo de rotas e todo o resto do 
        sistema continua funcionando, porque o apelido não mudou.

        Exemplo de uso:

        // No arquivo de rotas
        Route::get('/jogos-antigos-da-venda', [GameController::class, 'index'])->name('games.index');

        // Em qualquer outro lugar do código (Controller ou View)
        return redirect()->route('games.index'); 
        
        // O Laravel sabe que deve levar o usuário para '/jogos-antigos-da-venda'

    */

    Route::post('/newGame', [GameController::class, 'store'])->name('games.store');
    Route::put('/update-game', [GameController::class, 'update'])->name('games.update');
    Route::delete('/{id}', [GameController::class, 'destroy'])->name('games.destroy');
});


Route::prefix('users')->group(function(){
 
    Route::get('/', [GameController::class, 'index'])->name('user.index');
 
})

?>