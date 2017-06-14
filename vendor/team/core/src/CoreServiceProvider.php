<?php 
namespace Team\Core;
use Illuminate\Support\ServiceProvider;
use Team\Core\App\Commands\Install;
use Illuminate\Support\Facades\Route;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'admin');
        $this->publishes([
            __DIR__ . '/config' => config_path(),
            __DIR__ . '/database/migrations' => base_path('database/migrations/admin'),
            __DIR__ . '/database/seeds' => base_path('database/seeds'),
        ]);
        Route::middleware('web')
             ->namespace('Team\Core\App\Controllers')
             ->group(__DIR__ . '/app/routes.php');
    }

    public function register()
    {
    	$this->app->singleton('admininstall',function() {
            return new Install;
        });
        $this->app->singleton('moduleinit',function() {
            return new Install;
        });
        $this->commands('admininstall');
    }
}
