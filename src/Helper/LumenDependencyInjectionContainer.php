<?php

namespace Veloci\Lumen\Helper;

use Closure;
use Laravel\Lumen\Application;
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
     * @var string[]
     */
    private $classes;

    /**
     * LumenDependencyInjectionContainer constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app     = $app;
        $this->classes = [];
    }

    /**
     * @param string $alias
     * @param string $class
     */
    public function registerClass($alias, $class)
    {
        $this->app->bind($alias, $class);

        $this->classes[$alias] = $class;
    }

    /**
     * @param string $alias
     * @param Closure $closure
     */
    public function registerClosure($alias, Closure $closure)
    {
        $this->app->bind($alias, $closure);

        $this->classes[$alias] = null;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function get($alias)
    {
        return $this->app->make($alias);
    }

    /**
     * @param $alias
     * @return string | null
     */
    public function getClass($alias)
    {
        if (!array_key_exists($alias, $this->classes)) {
            return null;
        }

        $class = $this->classes[$alias];

        if (!$class) {
            $class                 = get_class($this->app[$alias]);
            $this->classes[$alias] = $class;
        }

        return $class;
    }
}