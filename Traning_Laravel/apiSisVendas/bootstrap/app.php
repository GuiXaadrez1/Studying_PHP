<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        /* web: __DIR__.'/../routes/web.php', isso esta me dando bo */
        commands: __DIR__.'/../routes/console.php',
        /* api: __DIR__.'/../routes/api.php', */
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    // Aqui configura o nosso Middleware
    ->withMiddleware(function (Middleware $middleware): void {

        // Diz ao Laravel: "Se não estiver logado, mande para admin.login"
        $middleware->redirectGuestsTo(function ($request) {
            
            // Se a URL contiver 'adm', manda para o login do admin
            if ($request->is('adm/*')) {
                return route('admin.login');
            }

            // Se for funcionário, mandaria para outra
            //  return route('funcionario.login'); // ainda nao implentei, vai dar erro!
        });

        // nosso middleware para funcionar pertence ao grupo 'api', isto é...
        // todos os nossos caminhos tem que ter o prefixo api
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Aqui colocamos as excessões lançadas pelo nosso midleware no laravel

        $exceptions->shouldRenderJsonWhen(function ($request, $e) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });
        
    })->create();
