<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Aquí podés registrar tus policies si más adelante usás
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Solo el manager puede hacer todo
        Gate::define('manage-everything', function (User $user) {
            return $user->role === 'manager';
        });

        // El manager y los estilistas pueden ver horarios
        Gate::define('view-schedule', function (User $user) {
            return in_array($user->role, ['manager', 'stylist']);
        });
    }
}
