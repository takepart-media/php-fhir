<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Hapi;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ConditionResource;

class ConditionService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Condition', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $conditionId)
    {
        $conditionId = $this->stripCharacters($conditionId);

        return $this->get("/Condition/$conditionId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(ConditionResource $condition)
    {
        return $this->post('/Condition', $condition->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $conditionId, ConditionResource $condition)
    {
        $conditionId = $this->stripCharacters($conditionId);

        return $this->put("/Condition/$conditionId", $condition->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $conditionId)
    {
        $conditionId = $this->stripCharacters($conditionId);

        return $this->delete("/Condition/$conditionId");
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(ConditionResource $condition, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Condition/$validate', $condition->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
