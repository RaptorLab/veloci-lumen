<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 17/04/16
 * Time: 19:42
 */

namespace Veloci\Lumen\Command;


use Illuminate\Console\Command;
use Veloci\Core\Helper\DependencyInjectionContainer;

class ContainerDebugCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'debug:container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List the container registered classes.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        /** @var DependencyInjectionContainer $container */
        $container = $this->laravel->make(DependencyInjectionContainer::class);

        $classes = $container->debug();

        foreach ($classes as $interface => $class) {
            $this->info($interface . ":\e[1;33m $class\033[0m");
        }
    }

}