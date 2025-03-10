<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\OrganizationResource;

class OrganizationService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Organization', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $organizationId)
    {
        $organizationId = $this->stripCharacters($organizationId);

        return $this->get("/Organization/$organizationId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(OrganizationResource $organization)
    {
        return $this->post('/Organization', $organization->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $organizationId, OrganizationResource $organization)
    {
        $organizationId = $this->stripCharacters($organizationId);

        return $this->put("/Organization/$organizationId", $organization->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $organizationId)
    {
        $organizationId = $this->stripCharacters($organizationId);

        return $this->delete("/Organization/$organizationId");
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(OrganizationResource $organization, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Organization/$validate', $organization->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
