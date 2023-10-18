<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
        // $this->registerPolicies();

        Gate::define('manage_masterData', function($user){
            return $user->hasAnyPermission([
                'kolam',
                'kategoriIn',
                'kategoriOut',
            ]);
        });

        Gate::define('manage_penjualan', function($user){
            return $user->hasAnyPermission([
                'penjualan_index',
                'penjualan_create',
                'penjualan_store',
                'penjualan_edit',
                'penjualan_update',
                'penjualan_destroy'
            ]);
        });

        Gate::define('manage_pembelian', function($user){
            return $user->hasAnyPermission([
                'pembelian_index',
                'pembelian_create',
                'pembelian_store',
                'pembelian_edit',
                'pembelian_update',
                'pembelian_destroy'
            ]);
        });

        Gate::define('manage_laporan', function($user){
            return $user->hasAnyPermission([
                'laporan_index',
                'laporan_search',
                'laporan_download',
            ]);
        });

        Gate::define('manage_user', function($user){
            return $user->hasAnyPermission([
                'user_index',
                'user_create',
                'user_store',
                'user_edit',
                'user_update',
                'user_destroy',
            ]);
        });

        Gate::define('manage_role', function($user){
            return $user->hasAnyPermission([
                'role_index',
                'role_create',
                'role_store',
                'role_edit',
                'role_update',
                'role_destroy',
            ]);
        });

    }
}
