<?php

namespace Backstage\Helpers\Utilities;

use Illuminate\Support\Facades\App;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionNamedType;

class Invoker
{
    protected array $args;

    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    /**
     * Invoke a callable with the given arguments.
     * 
     * @param array $args Positional or associative arguments to bind.
     * @param callable|null $callback Optional callable to invoke.
     * @return mixed|static Returns the result of the callable or an instance of Invoker
     */
    public static function invoke(array $args = [], ?callable $callback = null): mixed
    {
        $instance = new self($args);

        if ($callback !== null) {
            return $instance->call($callback);
        }

        return $instance;
    }

    /**
     * Bind positional or associative arguments (overwrites existing).
     *
     * @param mixed ...$args
     * @return static
     */
    public function bind(...$args): static
    {
        if (count($args) === 1 && is_array($args[0]) && $this->isAssoc($args[0])) {
            $this->args = $args[0];
        } else {
            $this->args = $args;
        }

        return $this;
    }

    /**
     * Call the given callable, resolving parameters from bound args or container.
     *
     * @param callable $callback
     * @return mixed
     */
    public function call(callable $callback): mixed
    {
        if (is_array($callback) && is_string($callback[0])) {
            $callback[0] = App::make($callback[0]);
        }

        $reflection = is_array($callback)
            ? new ReflectionMethod($callback[0], $callback[1])
            : new ReflectionFunction($callback);

        $params = $reflection->getParameters();

        $args = [];

        foreach ($params as $i => $param) {
            $name = $param->getName();

            if (array_key_exists($name, $this->args)) {
                $args[$i] = $this->args[$name];
                
                continue;
            }

            if (array_key_exists($i, $this->args)) {
                $args[$i] = $this->args[$i];

                continue;
            }

            $type = $param->getType();

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                $args[$i] = App::make($type->getName());

                continue;
            }

            if ($param->isDefaultValueAvailable()) {
                $args[$i] = $param->getDefaultValue();

                continue;
            }

            throw new \InvalidArgumentException("Unresolvable parameter: \${$name}");
        }

        return $callback(...$args);
    }

    /**
     * Check if the given array is associative.
     *
     * @param array $arr
     * @return bool
     */
    protected function isAssoc(array $arr): bool
    {
        if ([] === $arr) return false;

        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
