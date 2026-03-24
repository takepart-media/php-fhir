<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ResearchSubjectResource;

class ResearchSubjectService extends ResourceService
{
    protected function resourceName(): string { return 'ResearchSubject'; }

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
