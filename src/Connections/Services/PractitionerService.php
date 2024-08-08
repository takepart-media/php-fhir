<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\PractitionerResource;

class PractitionerService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Practitioner', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $practitionerId)
    {
        $practitionerId = $this->stripCharacters($practitionerId);

        return $this->get("/Practitioner/$practitionerId");
    }

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
