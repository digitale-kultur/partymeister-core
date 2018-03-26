<?php

namespace Partymeister\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Partymeister\Core\Console\Commands\PartymeisterCoreImportTicketsCommand;

class PartymeisterServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->config();
        $this->routes();
        $this->routeModelBindings();
        $this->translations();
        $this->views();
        $this->navigationItems();
        $this->permissions();
        $this->registerCommands();
        $this->migrations();
    }

    public function config()
    {

    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PartymeisterCoreImportTicketsCommand::class,
            ]);
        }
    }


    public function migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }


    public function permissions()
    {
        $config = $this->app['config']->get('motor-backend-permissions', []);
        $this->app['config']->set('motor-backend-permissions',
            array_replace_recursive(require __DIR__ . '/../../config/motor-backend-permissions.php',
                $config));
    }

    public function routes()
    {
        if ( ! $this->app->routesAreCached()) {
            require __DIR__ . '/../../routes/web.php';
            require __DIR__ . '/../../routes/api.php';
        }
    }


    public function translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'partymeister-core');

        $this->publishes([
            __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/partymeister-core'),
        ], 'motor-backend-translations');
    }


    public function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'partymeister-core');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/partymeister-core'),
        ], 'motor-backend-views');
    }


    public function routeModelBindings()
    {
        Route::bind('callback', function($id){
            return \Partymeister\Core\Models\Callback::findOrFail($id);
        });
        Route::bind('schedule', function($id){
            return \Partymeister\Core\Models\Schedule::findOrFail($id);
        });
        Route::bind('event', function($id){
            return \Partymeister\Core\Models\Event::findOrFail($id);
        });
        Route::bind('event_type', function($id){
            return \Partymeister\Core\Models\EventType::findOrFail($id);
        });
        Route::bind('guest', function($id){
            return \Partymeister\Core\Models\Guest::findOrFail($id);
        });
        Route::bind('visitor', function($id){
            return \Partymeister\Core\Models\Visitor::findOrFail($id);
        });
    }


    public function navigationItems()
    {
        $config = $this->app['config']->get('motor-backend-navigation', []);
        $this->app['config']->set('motor-backend-navigation',
            array_replace_recursive(require __DIR__ . '/../../config/motor-backend-navigation.php', $config));
    }
}