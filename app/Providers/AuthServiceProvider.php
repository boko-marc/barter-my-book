<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Core\Books\Models\Books;
use Core\Books\Policies\BooksPolicies;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Books::class => BooksPolicies::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
