<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\MedicationStatementResource;

class MedicationStatementService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/MedicationStatement', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $medicationStatementId)
    {
        $medicationStatementId = $this->stripCharacters($medicationStatementId);

        return $this->get("/MedicationStatement/$medicationStatementId");
    }

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

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $medicationStatementId)
    {
        $medicationStatementId = $this->stripCharacters($medicationStatementId);

        return $this->delete("/MedicationStatement/$medicationStatementId");
    }
}
