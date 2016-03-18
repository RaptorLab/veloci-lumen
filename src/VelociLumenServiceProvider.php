<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/03/16
 * Time: 16:09
 */

namespace Veloci\Lumen;

use Illuminate\Support\ServiceProvider;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Lumen\Helper\LumenDependencyInjectionContainer;

class VelociLumenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        require __DIR__ . '/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DependencyInjectionContainer::class, function ($app) {
            return new LumenDependencyInjectionContainer($app);
        });
    }
}