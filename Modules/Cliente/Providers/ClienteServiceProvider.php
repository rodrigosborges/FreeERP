<?php

namespace Modules\Cliente\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Validator;

class ClienteServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Validator::extend('telefone', 'Modules\Cliente\Validators\TelefoneValidator@validate');
        Validator::extend('cpf', 'Modules\Cliente\Validators\CpfValidator@validate');
        Validator::extend('cnpj', 'Modules\Cliente\Validators\CnpjValidator@validate');
        Validator::extend('docunico', 'Modules\Cliente\Validators\DocUniqueValidator@validate');
    }

    
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('cliente.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'cliente'
        );
    }

    
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/cliente');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/cliente';
        }, \Config::get('view.paths')), [$sourcePath]), 'cliente');
    }
 
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/cliente');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'cliente');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'cliente');
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
