<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB; // Pastikan ini ada

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
        // Menambahkan statement untuk mengaktifkan foreign keys di SQLite
        if (config('database.default') == 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON');
        }
    }
}

