<?php

namespace Modules\EstoqueMadeireira\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Validator;

class EstoqueMadeireiraServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cpf', 'Modules\EstoqueMadeireira\Validators\cpfValidator@validate');
        Validator::extend('telefone', 'Modules\EstoqueMadeireira\Validators\telefoneValidator@validate');
        Validator::extend('cnpj', 'Modules\EstoqueMadeireira\Validators\cnpjValidator@validate');
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('estoquemadeireira.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'estoquemadeireira'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/estoquemadeireira');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/estoquemadeireira';
        }, \Config::get('view.paths')), [$sourcePath]), 'estoquemadeireira');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/estoquemadeireira');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'estoquemadeireira');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'estoquemadeireira');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
