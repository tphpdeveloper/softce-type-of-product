<?php

namespace Softce\Type\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Softce\Type\Module\Type;
use Softce\Type\TypeButton\BuildButton;
use Softce\Type\TypeButton\Contracts\TypeButton;

class TypeServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->loadRoutesFrom(dirname(__DIR__).'\routes\web.php');
        $this->loadViewsFrom(dirname(__DIR__) . '\views', 'typeofproduct');
        $this->loadMigrationsFrom(dirname(__DIR__) . '/migrations');

        $slider = DB::table('admin_menus')->where('name', 'Типы товаров')->first();
        if(is_null($slider)){
            DB::table('admin_menus')->insert([
                'admin_menu_id' => 5,
                'name' => 'Типы товаров',
                'icon' => 'fa-list',
                'route' => 'admin.type.index',
                'o' => 0
            ]);
        }

//        $this->publishes([
//            dirname(__DIR__) . '\views\admin'       => dirname(public_path()) . '/modules/mage2/ecommerce/resources/views/admin/type',
//        ], 'view.type');
//        $this->publishes([
//            dirname(__DIR__) . '\Http\Controllers'  => dirname(public_path()) . '/modules/mage2/ecommerce/src/Http/Controllers/Admin',
//        ],'controller.type');
//        $this->publishes([
//            dirname(__DIR__) . '\Http\Requests'     => dirname(public_path()) . '/modules/mage2/ecommerce/src/Http/Requests',
//        ],'requests.type');
    }

    public function register()
    {
        $this->app->singleton(TypeButton::class, function(){
            return new BuildButton(Type::all());
        });
    }

}