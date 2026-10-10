<?php

namespace App\Providers;

use App\Models\ProfileSekolah;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $profile = ProfileSekolah::first();
        View::share('profile', $profile);
    }
}
