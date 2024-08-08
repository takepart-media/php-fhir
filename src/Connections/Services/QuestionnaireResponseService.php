<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResponseResource;

class QuestionnaireResponseService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/QuestionnaireResponse', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $questionnaireResponseId)
    {
        $questionnaireResponseId = $this->stripCharacters($questionnaireResponseId);

        return $this->get("/QuestionnaireResponse/$questionnaireResponseId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(QuestionnaireResponseResource $questionnaireResponse)
    {
        return $this->post('/QuestionnaireResponse', $questionnaireResponse->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $questionnaireResponseId, QuestionnaireResponseResource $questionnaireResponse)
    {
        $questionnaireResponseId = $this->stripCharacters($questionnaireResponseId);

        return $this->put("/QuestionnaireResponse/$questionnaireResponseId", $questionnaireResponse->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(QuestionnaireResponseResource $questionnaireResponse, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/QuestionnaireResponse/$validate', $questionnaireResponse->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
