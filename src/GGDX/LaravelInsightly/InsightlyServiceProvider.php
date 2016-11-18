<?php namespace GGDX\LaravelInsightly;

use Illuminate\Support\ServiceProvider;
use GGDX\PhpInsightly\Insightly as Insightly;

class InsightlyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/insightly.php' => config_path('insightly.php'),
        ]);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app['ggdx.php-insightly'] = $this->app->share(function($app){
            $config = $app->config->get('insightly', []);

            return new Insightly($config['api_key'], $config['api_version']);
        });


        $this->app->bind('GGDX\LaravelInsightly\Insightly', 'ggdx.php-insightly');
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
