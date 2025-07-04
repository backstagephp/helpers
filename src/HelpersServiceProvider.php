<?php

namespace Backstage\Helpers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Backstage\Helpers\Commands\HelpersCommand;

class HelpersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('helpers')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_helpers_table')
            ->hasCommand(HelpersCommand::class);
    }
}
