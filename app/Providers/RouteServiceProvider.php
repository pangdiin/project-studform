<?php

namespace App\Providers;

use App\Models\Access\User\User;
use App\Models\Tag;
use App\Models\Page;
use App\Models\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Register route model bindings
         */

        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('deletedUser', function ($value) {
            $user = new User();

            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });
        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('tag_type', function ($value) {
            $key = array_key_exists($value, config('tag.type'));
            if($key){ return (config('tag.type')[$value]); }
            abort(404);
        });

        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('tag_type_or_node', function ($value) {
            $key = array_key_exists($value, config('tag.type'));
            if($key){ return config('tag.type')[$value]; }
            $classes = config('menu.menus');
            foreach ($classes as $c => $class) {
                $class = app()->make($class['class']);
                $item = $class->whereSlug($value)->first();
                if($item){ return $item; }
            }
            abort(404);
        });

       
        $this->bind('front_page', function($value){
            // $model = View::whereSlug($value)->first();
            // if($model){
            //     return $model;
            // }else{
                return Page::whereSlug($value)->firstOrFail();
            // }
            // abort(404);
        });




        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
