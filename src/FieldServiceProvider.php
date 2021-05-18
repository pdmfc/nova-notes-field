<?php

namespace PDMFC\NovaNotesField;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-notes-field', __DIR__ . '/../dist/js/field.js');
            Nova::style('nova-notes-field', __DIR__ . '/../dist/css/field.css');
        });

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Register package routes
     *
     * @return void
     */
    public function registerRoutes(): void
    {
        Route::middleware(['nova'])
            ->prefix('nova-vendor/notes-field')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
