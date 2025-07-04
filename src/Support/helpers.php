<?php

use Backstage\Helpers\Facades\Helpers;
use Backstage\Helpers\Utilities\Invoker;

if (! function_exists('invoke')) {
    /**
     * @return mixed|Invoker
     */
    function invoke(...$params): mixed
    {
        return Helpers::invoke(...$params);
    }
}
