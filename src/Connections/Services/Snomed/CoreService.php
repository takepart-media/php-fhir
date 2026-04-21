<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Snomed;

use Takepartdev\LaravelFhir\Exceptions\SnomedConnectionException;

class CoreService
{
    private array $initializedServices;

    private string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->initializedServices = [];
    }

    private static array $classMap = [
        'valueSet' => ValueSetService::class,
    ];

    private function getServiceClass($name)
    {
        return array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }

    /**
     * @throws SnomedConnectionException
     */
    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);
        if (! $serviceClass) {
            throw new SnomedConnectionException('Undefined property: ' . static::class . '::$' . $name);
        }

        $this->initializedServices[$name] = new $serviceClass($this->baseUrl);

        return $this->initializedServices[$name];
    }
}
