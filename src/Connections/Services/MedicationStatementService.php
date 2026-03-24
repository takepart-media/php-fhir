<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\MedicationStatementResource;

class MedicationStatementService extends ResourceService
{
    protected function resourceName(): string { return 'MedicationStatement'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(MedicationStatementResource $medicationStatement)
    {
        return $this->post('/MedicationStatement', $medicationStatement->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $medicationStatementId, MedicationStatementResource $medicationStatement)
    {
        $medicationStatementId = $this->stripCharacters($medicationStatementId);

        return $this->put("/MedicationStatement/$medicationStatementId", $medicationStatement->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(MedicationStatementResource $medicationStatement, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/MedicationStatement/$validate', $medicationStatement->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
