<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Hapi;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ObservationResource;

class ObservationService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Observation', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $observationId)
    {
        $observationId = $this->stripCharacters($observationId);

        return $this->get("/Observation/$observationId");
    }

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
     */
    public function destroy(string $observationId)
    {
        $observationId = $this->stripCharacters($observationId);

        return $this->delete("/Observation/$observationId");
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
