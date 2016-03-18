<?php

namespace Veloci\Lumen\Helper;

use Veloci\Core\Helper\DependencyInjectionContainer;

/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 11:12
 */
class LumenDependencyInjectionContainer implements DependencyInjectionContainer
{

    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    private $app;

    /**
     * LumenDependencyInjectionContainer constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $alias
     * @param string $class
     */
    public function registerClass($alias, $class)
    {
        $this->app->bind($alias, $class);
    }

    /**
     * @param string $alias
     * @param Closure $closure
     */
    public function registerClosure($alias, Closure $closure)
    {
        $this->app->bind($alias, $closure);
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function get($alias)
    {
        return $this->app->make($alias);
    }
}