<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\BundleResource;

class BundleService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Bundle', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $bundleId)
    {
        $bundleId = $this->stripCharacters($bundleId);

        return $this->get("/Bundle/$bundleId");
    }

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
