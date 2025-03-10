<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResource;

class QuestionnaireService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/Questionnaire', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $questionnaireId)
    {
        $questionnaireId = $this->stripCharacters($questionnaireId);

        return $this->get("/Questionnaire/$questionnaireId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(QuestionnaireResource $questionnaire)
    {
        return $this->post('/Questionnaire', $questionnaire->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $questionnaireId, QuestionnaireResource $questionnaire)
    {
        $questionnaireId = $this->stripCharacters($questionnaireId);

        return $this->put("/Questionnaire/$questionnaireId", $questionnaire->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $questionnaireId)
    {
        $questionnaireId = $this->stripCharacters($questionnaireId);

        return $this->delete("/Questionnaire/$questionnaireId");
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(QuestionnaireResource $questionnaire, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/Questionnaire/$validate', $questionnaire->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
