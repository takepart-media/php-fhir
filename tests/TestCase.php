<?php

namespace Takepartdev\LaravelFhir\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Takepartdev\LaravelFhir\FhirProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            FhirProvider::class,
        ];
    }

    public static function fixturePath(string $path = ''): string
    {
        return __DIR__ . '/fixtures' . ($path !== '' ? '/' . ltrim($path, '/') : '');
    }
}
