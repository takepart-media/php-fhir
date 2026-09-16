<?php

namespace Takepartdev\LaravelFhir;

use Illuminate\Support\ServiceProvider;

class FhirProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/fhir.php', 'fhir');
    }

    public function boot(): void
    {
        $this->publishes([
            dirname(__DIR__) . '/config/fhir.php' => config_path('fhir.php'),
        ], 'takepart-php-fhir-config');
    }
}
