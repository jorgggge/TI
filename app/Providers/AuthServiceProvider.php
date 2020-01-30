<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate; 


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Company' => 'App\Policies\CompanyPolicy',
        'App\Evidences' => 'App\Policies\EvidencePolicy'

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();
        $gate->before(function ($user, $ability) {
            if ($user->hasRole('superAdmin')) {
                return true;
            }
        });
        //
    }
}