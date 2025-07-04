<?php

namespace Backstage\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Backstage\Helpers\Helpers
 */
class Helpers extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Backstage\Helpers\Helpers::class;
    }
}
