<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// para realizar tokens e mapeamento de usuários na navegacao do sistema
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

// realizando o binding entre reposiroty e contrato(interface)

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Contracts\AdminInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminInterface::class,AdminRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
