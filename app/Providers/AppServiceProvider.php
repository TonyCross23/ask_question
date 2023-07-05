<?php

namespace App\Providers;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        //session flashing 
        Inertia::share('flash',function(){
         return [
               'success'=>Session::get('success'),
               'error'=>Session::get('error')
         ];
        });

        // user share
        Inertia::share([
            'auth_user' => function(){
                return Auth::user();
            },
            'tag' => function(){
                return Tag::all();
            }
        ]);

     
    }
}