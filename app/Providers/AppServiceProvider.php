<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\AnneeAcademique;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // 1. DÉFINIR LA LOCALE EN PREMIER
        Carbon::setLocale('fr');
        
        // 2. Force le changement de locale de l'application
        app()->setLocale('fr');
        
        // 3. Pour les dates Carbon
        \Carbon\Carbon::setLocale('fr');
        
        // 4. Pour les dates diffForHumans()
        \Carbon\Carbon::setHumanDiffOptions(\Carbon\Carbon::ONE_DAY_WORDS | \Carbon\Carbon::NO_ZERO_DIFF);

        // Share title to each page
        $project_title = '| OMNIS System';
        $allAnneeAcademiques = AnneeAcademique::orderBy('id', 'desc')->get();
        session()->put('lastAnneeAcademique', AnneeAcademique::latest()->first());

        View::share('title', $project_title);
        View::share('allAnneeAcademiques', $allAnneeAcademiques);

        // Get cookie 
        view()->composer('layouts.informatique.master', function ($view) {
            $theme = Cookie::get('theme');
        
            if ($theme != 'dark-theme' && $theme != 'light') {
                $theme = 'light';
            }
        
            $view->with('theme', $theme);
        });
    }
}
