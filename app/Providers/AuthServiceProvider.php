<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Droit de gérer (modifier / supprimer) les notes de rattrapage.
        // Liste des gestionnaires définie dans config/permissions.php (via RATTRAPAGE_MANAGERS).
        Gate::define('gerer-rattrapage', function ($user) {
            return in_array($user->email ?? null, config('permissions.rattrapage_managers', []), true);
        });
    }
}
