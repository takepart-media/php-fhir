<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ResearchStudyResource;

class ResearchStudyService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/ResearchStudy', $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $researchStudyId)
    {
        $researchStudyId = $this->stripCharacters($researchStudyId);

        return $this->get("/ResearchStudy/$researchStudyId");
    }

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
     */
    public function destroy(string $researchStudyId)
    {
        $researchStudyId = $this->stripCharacters($researchStudyId);

        return $this->delete("/ResearchStudy/$researchStudyId");
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
