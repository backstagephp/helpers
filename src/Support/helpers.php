<?php

use Backstage\Helpers\Utilities\Invoker;

/**
 * @return mixed|Invoker
 */
if (! function_exists('invoke')) {
    function invoke(...$params): mixed
    {
        $callback = null;

        if (count($params) > 0 && is_callable(end($params))) {
            $callback = array_pop($params);
        }

        return Invoker::invoke($params, $callback);
    }
}
