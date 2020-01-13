# Authentication logger for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Chrysanthos/password-history.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/password-history)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/chrysanthos/password-history/run-tests?label=tests)](https://github.com/chrysanthos/password-history/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/chrysanthos/password-history.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrysanthos/password-history)
[![Total Downloads](https://img.shields.io/packagist/dt/chrysanthos/password-history.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/password-history)

The Laravel package logs failed attempts to login. It stores the credentials used along with the user ip and user agent in a table where you can later check. A Nova tool will be provided soon. 

## Installation

You can install the package via composer:

```bash
composer require chrysanthos/password-history
```

## Usage

The package service provider is registered automatically and a migration is provided to be run. 

The only thing you need to do is run your migrations by running

``` bash
php artisan migrate
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please send me a message on twitter (@chrysanthos_cy) instead of using the issue tracker.

## Credits

- [Chrysanthos Prodromou](https://github.com/chrysanthos)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.