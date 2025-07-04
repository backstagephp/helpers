<?php

namespace Backstage\Helpers;

use Backstage\Helpers\Utilities\Invoker;

class Helpers
{
    public function invoke(...$params): mixed
    {
        $callback = null;

        if (count($params) > 0 && is_callable(end($params))) {
            $callback = array_pop($params);
        }

        return Invoker::invoke($params, $callback);
    }
}
