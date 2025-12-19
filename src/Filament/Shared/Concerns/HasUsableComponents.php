<?php

namespace Backstage\Helpers\Filament\Shared\Concerns;

use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Arr;

trait HasUsableComponents
{
    public static ?string $usableFormSchemaClass = null;

    public static ?string $usableInfolistSchemaClass = null;

    public static ?string $usableTableSchemaClass = null;

    public static array $usableRelationsClasses = [];

    public static bool $overwriteRelations = false;

    public static array $usablePagesClasses = [];

    public static bool $overwritePages = false;

    public static ?string $customModel = null;

    public static ?string $customNavigationGroup = null;

    public static function useCustomNavigationGroup(string $group): void
    {
        static::$customNavigationGroup = $group;
    }

    public static function useCustomModel(string $model): void
    {
        static::$customModel = $model;
    }

    public static function getNavigationGroup(): string
    {
        return static::$customNavigationGroup ?? static::makeNavigationGroup() ?? static::$navigationGroup;
    }

    public static function getModel(): string
    {
        /** @phpstan-ignore-next-line */
        return static::$customModel ?? static::$model;
    }

    public static function makeFormSchema(Schema $schema): Schema
    {
        return $schema;
    }

    public static function makeTableSchema(Table $table): Table
    {
        return $table;
    }

    public static function makeRelations(): array
    {
        return [];
    }

    public static function makePages(): array
    {
        return [];
    }

    public static function makeInfolistSchema(Schema $infolist): Schema
    {
        return $infolist;
    }

    public static function useFormSchema(string $class): void
    {
        static::$usableFormSchemaClass = $class;
    }

    public static function useInfolistSchema(string $class): void
    {
        static::$usableInfolistSchemaClass = $class;
    }

    public static function useTableSchema(string $class): void
    {
        static::$usableTableSchemaClass = $class;
    }

    public static function useRelations(array|string $classes, bool $overwrite = false): void
    {
        static::$usableRelationsClasses = Arr::wrap($classes);

        static::$overwriteRelations = $overwrite;
    }

    public static function usePages(array|string $classes, bool $overwrite = false): void
    {
        static::$usablePagesClasses = Arr::wrap($classes);

        static::$overwritePages = $overwrite;
    }

    public static function form(Schema $schema): Schema
    {
        if (static::$usableFormSchemaClass) {
            if (! method_exists(static::$usableFormSchemaClass, 'configure')) {
                throw new \Exception('The class '.static::$usableFormSchemaClass.' does not have a configure method');
            }

            return static::$usableFormSchemaClass::configure($schema);
        }

        return static::makeFormSchema($schema);
    }

    public static function infolist(Schema $infolist): Schema
    {
        if (static::$usableInfolistSchemaClass) {
            if (! method_exists(static::$usableInfolistSchemaClass, 'configure')) {
                throw new \Exception('The class '.static::$usableInfolistSchemaClass.' does not have a configure method');
            }

            return static::$usableInfolistSchemaClass::configure($infolist);
        }

        return static::makeInfolistSchema($infolist);
    }

    public static function table(Table $table): Table
    {
        if (static::$usableTableSchemaClass) {
            if (! method_exists(static::$usableTableSchemaClass, 'configure')) {
                throw new \Exception('The class '.static::$usableTableSchemaClass.' does not have a configure method');
            }

            return static::$usableTableSchemaClass::configure($table);
        }

        return static::makeTableSchema($table);
    }

    public static function getRelations(): array
    {
        $usingRelations = static::$usableRelationsClasses;

        $relations = static::makeRelations();

        if (empty($usingRelations)) {
            return $relations;
        }

        if (static::$overwriteRelations) {
            return $usingRelations;
        }

        return array_merge($usingRelations, $relations);
    }

    public static function getPages(): array
    {
        $usingPages = static::$usablePagesClasses;

        $pages = static::makePages();

        if (empty($usingPages)) {
            return $pages;
        }

        if (static::$overwritePages) {
            return $usingPages;
        }

        return array_merge($usingPages, $pages);
    }
}
