<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// para realizar tokens e mapeamento de usuários na navegacao do sistema
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;

// realizando o binding entre reposiroty e contrato(interface)

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Contracts\AdminInterface;

use App\Repositories\Category\CategoryProductRepositories;
use App\Repositories\Contracts\Categoryinterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminInterface::class,AdminRepository::class);
        $this->app->bind(Categoryinterface::class,CategoryProductRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Para configurar o Sanctum, sem isso ele nao funciona adequadamente
        // também é necessário consfigurar o auth.php e o sanctum.php
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
