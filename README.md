# Laravel-PayPal

## Introduction

The `laravel-paypal` package allows you to use the Paypal-SDK in a more laravel-ish way.

## Installation

Require the aplr/laravel-paypal package in your composer.json and update your dependencies:

```shell
$ composer require aplr/laravel-paypal
```
    
Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
    
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Aplr\LaravelPaypal\ServiceProvider::class,
```
    
If you want to use the facade to conveniently access the Paypal SDK, add this to your facades in app.php:

```php
'Paypal' => Aplr\LaravelPaypal\Facade::class,
```

## Configuration

The defaults are set in config/paypal.php. Copy this file to your own config directory to modify the values. You can publish the config using this command:

```shell
$ php artisan vendor:publish --provider="Aplr\LaravelPaypal\ServiceProvider"
```

When using the default package configuration, you can set the Paypal SDK credentials in your `.env` file.