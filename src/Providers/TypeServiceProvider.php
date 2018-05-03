<?php

namespace Softce\Type\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Softce\Type\Module\Type;
use Softce\Type\TypeButton\BuildButton;
use Softce\Type\TypeButton\Contracts\TypeButton;

class TypeServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(dirname(__DIR__) . '\routes\web.php');
        $this->loadViewsFrom(dirname(__DIR__) . '\views', 'typeofproduct');
        $this->loadMigrationsFrom(dirname(__DIR__) . '/migrations');

        $slider = DB::table('admin_menus')->where('name', 'Типы товаров')->first();
        if (is_null($slider)) {
            DB::table('admin_menus')->insert([
                'admin_menu_id' => 5,
                'name' => 'Типы товаров',
                'icon' => 'fa-list',
                'route' => 'admin.type.index',
                'o' => 0
            ]);
        }

    }

    public function register()
    {
        $this->app->singleton(TypeButton::class, function(){
            return new BuildButton(Type::with('product_type')->get());
        });
    }

}