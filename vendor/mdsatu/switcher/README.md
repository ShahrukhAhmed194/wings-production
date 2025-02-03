# Switcher

Switcher is used to easily switch database column status value of a specific table.


[GitHub license](https://github.com/mdsatu/switcher/blob/master/LICENSE), [GitHub issues](https://github.com/mdsatu/switcher/laravel-meta-manager/issues)

## Requirements

- PHP 5.4 or above
- Laravel 5.5 or above

## Steps:

* [Install](#install)
* [Configuration](#configuration)
* [Usage](#usage)
* [Example](#example)
* [Maintainers](#maintainers)
* [License](#license)


### Install

**Composer**

Run the following to include this package via Composer

```shell
composer require mdsatu/switcher
```

Once download is complete, the next thing you have to do is include the service provider within `config/app.php`.

```php
'providers' => [
        DWK\Switcher\SwitcherServiceProvider::class,
];
```
Then run `php artisan vendor:publish --provider="DWK\Switcher\SwitcherServiceProvider"` to get the config of Switcher.


### Configuration

Setup default application switcher in `switcher.php` config. (Optional but recommended)

#### Available options:

Option | Description
--------- | -------
`default_column` | Here you may specify the default column name.
`loader` | Here you may specify loader animation (Optional).



### Usage

Once configuration is complete you can add this code inside the body tag to activate the "Switcher".

```php
@include('switcher::code')
```

Now put this code where you want to preview the "Switch"


```php
@include('switcher::switch', [
    'table' => 'users',
    'data' => $query_data,
    'column' => 'status', // Optional
    'id' => 1 // Optional
])
```



### Example

```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        @include('switcher::switch', [
            'table' => 'users',
            'data' => $query_data
        ])
    </body>
    </html>
```


### Maintainers

This package is maintained by [MD Satu](https://mdsatu.github.io) and you!



### License

This package is licensed under the [MIT license](https://github.com/mdsatu/switcher/blob/master/LICENSE).
