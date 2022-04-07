<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        /* define a super admin user role */
        Gate::define('isSuperAdmin', function($user)
        {
            return $user->role_id == 1;
        });

        /* define a admin user role */
        Gate::define('isAdmin', function($user)
        {
            return $user->role_id == 2;
        });

        /* define a staff user role */
        Gate::define('isStaff', function($user)
        {
            return $user->role_id == 3;
        });

        //
    }
}
