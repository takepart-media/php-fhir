<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResource;

class QuestionnaireService extends ResourceService
{
    protected function resourceName(): string { return 'Questionnaire'; }

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
