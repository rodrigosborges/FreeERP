<?php

namespace Modules\Usuario\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Polices\UsuarioPolicy; 
class UsuarioServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Usuario::class => UsuarioPolicy::class,
    ];

    
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //$this->registrarPoliticas();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }


    /**
     * Criar politicas para cada uma das rotas por módulo, por exemplo:
     * Permissoes{
     *      Usuario{
     *           Papel{...},
     *           Usuario{
     *              trocar-senha : true,
     *              cadastrar : true,
     *              listar : true,
     *              atualizar : true,
     *              deletar : true,
     *              restaurar : true,
     *           },
     *           Modulo{...},
     *      },
     *      Cliente{...},
     * }
     */

    public function registrarPoliticas(){
        Gate::define('create-post', function($usuario){
            $usuario->temAcesso(['create-post']);
            return true;
        });
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
            __DIR__.'/../Config/config.php' => config_path('usuario.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'usuario'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/usuario');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/usuario';
        }, \Config::get('view.paths')), [$sourcePath]), 'usuario');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/usuario');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'usuario');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'usuario');
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
