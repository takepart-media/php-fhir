<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\EncounterResource;

class EncounterService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Encounter', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $encounterId)
    {
        $encounterId = $this->stripCharacters($encounterId);

        return $this->get("/Encounter/$encounterId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(EncounterResource $encounter)
    {
        return $this->post('/Encounter', $encounter->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $encounterId, EncounterResource $encounter)
    {
        $encounterId = $this->stripCharacters($encounterId);

        return $this->put("/Encounter/$encounterId", $encounter->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $encounterId)
    {
        $encounterId = $this->stripCharacters($encounterId);

        return $this->delete("/Encounter/$encounterId");
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(EncounterResource $encounter, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Encounter/$validate', $encounter->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
