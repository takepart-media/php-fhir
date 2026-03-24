<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\MedicationResource;

class MedicationService extends ResourceService
{
    protected function resourceName(): string { return 'Medication'; }

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
}
