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
use Veloci\Core\Repository\InMemoryKeyValueStore;
use Veloci\Lumen\Command\ContainerDebugCommand;
use Veloci\Lumen\Factory\UserResolverFactory;
use Veloci\Lumen\Factory\UserResolverFactoryDefault;
use Veloci\Lumen\Helper\LumenDependencyInjectionContainer;
use Veloci\Lumen\Resolver\StandardUserResolver;
use Veloci\Lumen\Resolver\UserResolver;
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

        $this->app->bind(
            UserResolverFactory::class,
            function () use ($dependencyInjectionContainer) {
                $userResolverFactory = new UserResolverFactoryDefault(
                    new InMemoryKeyValueStore(),
                    $dependencyInjectionContainer
                );

                $userResolverFactory->registerUserResolver(StandardUserResolver::class);
                return $userResolverFactory;
            }
        );

//        $this->app->instance(ExceptionHandler::class, function () {
//            return new Handler();
//        });

        $this->app->singleton('command.debug.container', function (){
            return new ContainerDebugCommand();
        });

        $this->commands('command.debug.container');

        $configuration = $this->getConfiguration();

        new UserPackage($dependencyInjectionContainer, $configuration);
    }

    private function getConfiguration():PackageConfiguration
    {
        $configuration = new PackageConfigurationDefault();

        $configuration->setDatabase(new DatabaseConfigurationDefault(config('database.type', 'mongodb')));

        return $configuration;
    }
}