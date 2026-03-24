<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ResearchStudyResource;

class ResearchStudyService extends ResourceService
{
    protected function resourceName(): string { return 'ResearchStudy'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(ResearchStudyResource $researchStudy)
    {
        return $this->post('/ResearchStudy', $researchStudy->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $researchStudyId, ResearchStudyResource $researchStudy)
    {
        $researchStudyId = $this->stripCharacters($researchStudyId);

        return $this->put("/ResearchStudy/$researchStudyId", $researchStudy->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(ResearchStudyResource $researchStudy, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/ResearchStudy/$validate', $researchStudy->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
