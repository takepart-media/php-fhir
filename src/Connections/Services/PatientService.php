<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\PatientResource;

class PatientService extends ResourceService
{
    protected function resourceName(): string { return 'Patient'; }

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
}
