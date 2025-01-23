<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       

        require_once app_path('Helpers/Funcoes.php');
        $this->register();

        Gate::define('Administrador', function ($user) {
            return $user->tipo === 'Admin';
        });
        Gate::define('Director', function ($user) {
            return $user->tipo === 'Diretor';
        });

        Gate::define('Pedagogico', function ($user) {
            return $user->tipo === 'Pedagogico';
        });

        Gate::define('Tecnico', function ($user) {
            return $user->tipo === 'Tecnico';
        });
    }
}
