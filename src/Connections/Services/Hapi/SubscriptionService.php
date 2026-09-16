<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Hapi;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\SubscriptionResource;

class SubscriptionService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Subscription', $orderByField, $orderByDirection, $options);
    }

    /**
     * Search by the R4 `url` search parameter, which matches Subscription.channel.endpoint.
     *
     * @throws HapiConnectionException
     */
    public function findByUrl(string $endpoint, array $options = [])
    {
        return $this->get(
            '/Subscription',
            null,
            null,
            array_merge($options, ['url' => urlencode($endpoint)]),
            ['Cache-Control' => 'no-store'],
        );
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $subscriptionId)
    {
        $subscriptionId = $this->stripCharacters($subscriptionId);

        return $this->get("/Subscription/$subscriptionId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(SubscriptionResource $subscription)
    {
        return $this->post('/Subscription', $subscription->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $subscriptionId, SubscriptionResource $subscription)
    {
        $subscriptionId = $this->stripCharacters($subscriptionId);

        return $this->put("/Subscription/$subscriptionId", $subscription->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(SubscriptionResource $subscription, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Subscription/$validate', $subscription->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $subscriptionId)
    {
        $subscriptionId = $this->stripCharacters($subscriptionId);

        return $this->delete("/Subscription/$subscriptionId");
    }
}
