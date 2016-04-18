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
     * @var Application
     */
    private $app;

    /**
     * @var string[]
     */
    private $classes;

    /**
     * LumenDependencyInjectionContainer constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app     = $app;
        $this->classes = [];
    }

    /**
     * @param string $alias
     * @param string $class
     * @param Closure $generator
     */
    public function registerClass($alias, $class, Closure $generator = null)
    {
        $this->classes[$alias] = $class;

        if ($generator === null) {
            $this->app->bind($alias, $class);
        } else {
            $this->app->bind($alias, $generator);
        }
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

    /**
     * @param $alias
     * @return bool
     */
    public function contains($alias):bool
    {
        return array_key_exists($alias, $this->classes);
    }

    /**
     * @return array
     */
    public function debug():array
    {
        return $this->classes;
    }
}