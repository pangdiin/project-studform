<?php

namespace App\Providers;

use App\Services\Setting\Setting;
use App\Services\Menu\Menu;
use App\Services\Block\Block;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * Class SettingServiceProvider.
 */
class SettingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method.
     */
    public function boot()
    {
        Relation::morphMap([
            'page'      => '\App\Models\Page',
            'tag'       => '\App\Models\Tag',
            'product'   => '\App\Models\Product\Product',
            'project'   => '\App\Models\Project\Project',
            'block'     => '\App\Models\Block',
            'view'      => '\App\Models\View\View',
            'brochure'  => '\App\Models\Product\Brochure',
            'gallery'   => '\App\Models\Product\Gallery'
        ]);
        if(Schema::hasTable('nodes')){
            $this->cacheData();
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
        $this->registerFacade();
    }

    /**
     * Cache all data that does not need to load
     */
    public function cacheData()
    {
        setting()->cacheSettings();
        menu()->cacheSave();
        block()->cacheSave();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAccess()
    {
        $this->app->bind('setting', function ($app) {
            return new Setting($app);
        });

        $this->app->bind('menu', function ($app) {
            return new Menu($app);
        });

        $this->app->bind('block', function ($app) {
            return new Block($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Setting', \App\Services\Setting\Facades\Setting::class);
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Menu', \App\Services\Menu\Facades\Menu::class);
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Block', \App\Services\Block\Facades\Block::class);
        });
    }

}
