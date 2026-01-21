<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


/*
 *  Aqui em AppServiceProvider, podemos registrar serviços e realizar
 * configurações globais para a aplicação Laravel.php
 * Ou seja,aqui realizamos o bind entre o contrato e a implementação concreta do Repository
 */

// Importando o contrato/interface e a implementação concreta do nosso Repository
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\User\UserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * Sempre realize o bind no register nunca no boot
     */
    public function register(): void
    {   
        // basicamente estamos falando para o laravel! 
        // Se um construtor chamar essa interface, entregue essa Class
        // lembrando que ::class retorna o caminho completo do arquivo.
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
