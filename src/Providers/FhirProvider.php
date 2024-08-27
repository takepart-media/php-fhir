<?php

namespace Takepartdev\LaravelFhir\Providers;

use Illuminate\Support\ServiceProvider;

class FhirProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/config.php', 'fhir');
    }

    public function boot(): void
    {
        $this->publishes([
            dirname(__DIR__).'/Config/config.php' => config_path('fhir.php'),
        ], 'takepart-laravel-fhir-config');
    }
}
