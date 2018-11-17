<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        \Validator::extend('hashCheck', function ($attribute, $value, $parameters, $validator) {
            $user = User::find($validator->getData()['user']['id']);
            return \Hash::check($value, $user->password);
        });
        view()->composer('*', function ($view) {
            $sidebar = collect([
                (object)
                [
                    'is_parent' => 1,
                    'icon' => 'fa-sitemap',
                    'name' => 'Organization',
                    'child' => [
                        (object) [
                            'href' => 'admin/management/organization',
                            'name' => 'List Organization',
                        ],
                    ],
                ],
                [
                    'is_parent' => 1,
                    'icon' => 'fa-group',
                    'name' => 'Role',
                    'child' => [
                        (object) [
                            'href' => 'admin/management/organization',
                            'name' => 'List Organization',
                        ],
                    ],
                ],

            ]);
            $view->with('sideBar', $sidebar);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
