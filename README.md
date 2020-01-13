# Password history for Laravel 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Chrysanthos/password-history.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/password-history)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/chrysanthos/password-history/run-tests?label=tests)](https://github.com/chrysanthos/password-history/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/chrysanthos/password-history.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrysanthos/password-history)
[![Total Downloads](https://img.shields.io/packagist/dt/chrysanthos/password-history.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/password-history)

The Laravel package maintains user password history so that you can prevent users to change their password to one they used in the past. 

## Installation

You can install the package via composer:

```bash
composer require chrysanthos/password-history
```

## Usage

The package service provider is registered automatically and a migration is provided to be run. 

Run your migrations
``` bash
php artisan migrate
```

In your `App\Http\Controllers\Auth\ResetPasswordController` override Laravel's default `rules` method with the following
```php
    use Chrysanthos\PasswordHistory\Rules\NoOldPasswords;

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required', 'confirmed', 'min:8',
                new NoOldPasswords(User::whereEmail(request('email'))->first()->id, request('password'))
            ],
        ];
    }
```

Note: In case you changed the default Laravel auth `ResetPasswordController` you will need to dispatch the `PasswordReset` event that Laravel includes out of the box.
```php
    use Illuminate\Auth\Events\PasswordReset;

    event(new PasswordReset($user));
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
