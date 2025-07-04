<?php

namespace Backstage\Helpers;

use Backstage\Helpers\Commands\HelpersCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('backstage/helpers');
    }
}
