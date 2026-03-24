<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\OrganizationResource;

class OrganizationService extends ResourceService
{
    protected function resourceName(): string { return 'Organization'; }

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
