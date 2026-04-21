<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Hapi;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\PatientResource;

class PatientService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Patient', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $patientId)
    {
        $patientId = $this->stripCharacters($patientId);

        return $this->get("/Patient/$patientId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(PatientResource $patient)
    {
        return $this->post('/Patient', $patient->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $patientId, PatientResource $patient)
    {
        $patientId = $this->stripCharacters($patientId);

        return $this->put("/Patient/$patientId", $patient->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(PatientResource $patient, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Patient/$validate', $patient->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $patientId)
    {
        $patientId = $this->stripCharacters($patientId);

        return $this->delete("/Patient/$patientId");
    }
}
