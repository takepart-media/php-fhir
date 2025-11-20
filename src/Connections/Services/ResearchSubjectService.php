<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ResearchSubjectResource;

class ResearchSubjectService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/ResearchSubject', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $researchSubjectId)
    {
        $researchSubjectId = $this->stripCharacters($researchSubjectId);

        return $this->get("/ResearchSubject/$researchSubjectId");
    }

    /**
     * @throws HapiConnectionException
     */
    public function create(ResearchSubjectResource $researchSubject)
    {
        return $this->post('/ResearchSubject', $researchSubject->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $researchSubjectId, ResearchSubjectResource $researchSubject)
    {
        $researchSubjectId = $this->stripCharacters($researchSubjectId);

        return $this->put("/ResearchSubject/$researchSubjectId", $researchSubject->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $researchSubjectId)
    {
        $researchSubjectId = $this->stripCharacters($researchSubjectId);

        return $this->delete("/ResearchSubject/$researchSubjectId");
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(ResearchSubjectResource $researchSubject, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/ResearchSubject/$validate', $researchSubject->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
