<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\EncounterResource;

class EncounterService extends ResourceService
{
    protected function resourceName(): string { return 'Encounter'; }

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
