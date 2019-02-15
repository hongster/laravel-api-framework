<?php

namespace App\Api\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Convert exceptions into JSON error output
        $this->app->bind(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'App\Api\Exceptions\Handler'
        );
    }
}