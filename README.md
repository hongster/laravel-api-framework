# API Module

This is the framework for API web service. All responses are formatted in JSON format.

# Setup

`ApiServiceProvider` provides initialization. Just add the following line into `bootstrap/app.php` to get started.

```php
$app->register(App\Api\Providers\ApiServiceProvider::class);
```

These routes are *optional*, but *recommended*. The root URL should show some basic info to proof that this service is working.

```php
$router->get('/', ['uses' => '\App\Api\Controllers\MainController@index']);
$router->post('/', ['uses' => '\App\Api\Controllers\MainController@index']);
```

# Development Guide

All controllers should extend from `App\Api\Controllers\ApiController`.

To generate API errors,

1. Define a exception that extends from `App\Api\Exceptions\ApiException`.
1. **MUST** define an application-wide unique `$code`. (Sample: `App\Api\Exceptions\SampleException`)
1. Record this error code in root README.md file so that other developers know about it.

# TDOD

- [ ] Convert this into Composer package.