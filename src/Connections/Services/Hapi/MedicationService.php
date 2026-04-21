<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Hapi;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\MedicationResource;

class MedicationService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Medication', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $medicationId)
    {
        $medicationId = $this->stripCharacters($medicationId);

        return $this->get("/Medication/$medicationId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(MedicationResource $medication)
    {
        return $this->post('/Medication', $medication->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $medicationId, MedicationResource $medication)
    {
        $medicationId = $this->stripCharacters($medicationId);

        return $this->put("/Medication/$medicationId", $medication->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(MedicationResource $medication, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Medication/$validate', $medication->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $medicationId)
    {
        $medicationId = $this->stripCharacters($medicationId);

        return $this->delete("/Medication/$medicationId");
    }
}
