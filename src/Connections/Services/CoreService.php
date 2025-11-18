<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;

class CoreService
{
    private array $initializedServices;

    private string $baseUrl;

    private array $options;

    public function __construct(string $baseUrl, array $options = [])
    {
        $this->baseUrl = $baseUrl;
        $this->options = $options;
        $this->initializedServices = [];
    }

    private static array $classMap = [
        'serverAction' => ServerActionService::class,
        'bundles' => BundleService::class,
        'encounters' => EncounterService::class,
        'observations' => ObservationService::class,
        'organizations' => OrganizationService::class,
        'patients' => PatientService::class,
        'practitioners' => PractitionerService::class,
        'questionnaires' => QuestionnaireService::class,
        'questionnaireResponses' => QuestionnaireResponseService::class,
        'researchStudies' => ResearchStudyService::class,
    ];

    private function getServiceClass($name)
    {
        return array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }

    /**
     * @throws HapiConnectionException
     */
    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);
        if (! $serviceClass) {
            throw new HapiConnectionException('Undefined property: ' . static::class . '::$' . $name);
        }

        $this->initializedServices[$name] = new $serviceClass($this->baseUrl, $this->options);

        return $this->initializedServices[$name];
    }
}
