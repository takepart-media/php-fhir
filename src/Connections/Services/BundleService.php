<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\BundleResource;

class BundleService extends ResourceService
{
    protected function resourceName(): string { return 'Bundle'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(BundleResource|AbstractResource $bundle)
    {
        return $this->post('/Bundle', $bundle->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $bundleId, BundleResource $bundle)
    {
        $bundleId = $this->stripCharacters($bundleId);

        return $this->put("/Bundle/$bundleId", $bundle->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(BundleResource $bundle, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Bundle/$validate', $bundle->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
