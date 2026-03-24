<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ObservationResource;

class ObservationService extends ResourceService
{
    protected function resourceName(): string { return 'Observation'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(ObservationResource $observation)
    {
        return $this->post('/Observation', $observation->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $observationId, ObservationResource $observation)
    {
        $observationId = $this->stripCharacters($observationId);

        return $this->put("/Observation/$observationId", $observation->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(ObservationResource $observation, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Observation/$validate', $observation->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
