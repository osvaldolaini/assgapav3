<?php

namespace App\Providers;

use App\Models\Admin\Configs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
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
        // $configurations = Configs::find(1);
        // // Vincule os dados de configuração como uma variável global
        // config(['app.configs' => $configurations]);
    }
}
