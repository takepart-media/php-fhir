<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\PractitionerResource;

class PractitionerService extends ResourceService
{
    protected function resourceName(): string { return 'Practitioner'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(PractitionerResource $practitioner)
    {
        return $this->post('/Practitioner', $practitioner->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $practitionerId, PractitionerResource $practitioner)
    {
        $practitionerId = $this->stripCharacters($practitionerId);

        return $this->put("/Practitioner/$practitionerId", $practitioner->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(PractitionerResource $practitioner, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Practitioner/$validate', $practitioner->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
