<?php

namespace App\Providers;

use App\Factories\CategoryFactory;
use App\Factories\ProductFactory;
use App\Models\Category;
use App\Models\Language;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(CategoryRepositoryInterface::class, function(Container $app) {
            return new CategoryRepository(
                $app->make(CategoryFactory::class)
            );
        });

        $this->app->bind(ProductRepositoryInterface::class, function(Container $app) {
            return new ProductRepository(
                $app->make(ProductFactory::class)
            );
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->getMenus();

        App::singleton('language_id', function(){
                return Language::select('id')->where('code',  app()->getLocale())->first()->id;
        });
    }
}
