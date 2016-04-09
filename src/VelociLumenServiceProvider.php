<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 12/03/16
 * Time: 16:09
 */

namespace Veloci\Lumen;

use Illuminate\Support\ServiceProvider;
use Veloci\Core\Configuration\DatabaseConfigurationDefault;
use Veloci\Core\Configuration\PackageConfiguration;
use Veloci\Core\Configuration\PackageConfigurationDefault;
use Veloci\Core\Helper\DependencyInjectionContainer;
use Veloci\Lumen\Helper\LumenDependencyInjectionContainer;
use Veloci\User\UserPackage;

class VelociLumenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $dependencyInjectionContainer = new LumenDependencyInjectionContainer($this->app);

        $this->app->instance(DependencyInjectionContainer::class, $dependencyInjectionContainer);

//        $this->app->instance(ExceptionHandler::class, function () {
//            return new Handler();
//        });


        $configuration = $this->getConfiguration();

        new UserPackage($dependencyInjectionContainer, $configuration);
    }

    private function getConfiguration():PackageConfiguration
    {
        $configuration = new PackageConfigurationDefault();

        $configuration->setDatabase(new DatabaseConfigurationDefault(config('database.type')));

        return $configuration;
    }
}