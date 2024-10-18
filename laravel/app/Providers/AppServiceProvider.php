<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::aliasMiddleware('role', CheckRole::class);
    }

    
}
