# This is my package helpers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/backstage/helpers.svg?style=flat-square)](https://packagist.org/packages/backstage/helpers)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/backstage/helpers/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/backstage/helpers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/backstage/helpers/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/backstage/helpers/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/backstage/helpers.svg?style=flat-square)](https://packagist.org/packages/backstage/helpers)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require backstage/helpers
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="helpers-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="helpers-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="helpers-views"
```

## Usage

```php
$helpers = new Backstage\Helpers();
echo $helpers->echoPhrase('Hello, Backstage!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Manoj Hortulanus](https://github.com/arduinomaster22)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
