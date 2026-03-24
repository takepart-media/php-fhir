<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;
use Takepartdev\LaravelFhir\Resources\ListResource;

class ListService extends ResourceService
{
    protected function resourceName(): string { return 'List'; }

    /**
     * @throws HapiConnectionException
     */
    public function create(ListResource $list)
    {
        return $this->post('/List', $list->toArray());
    }

    /**
     * @throws HapiConnectionException
     */
    public function update(string $listId, ListResource $list)
    {
        $listId = $this->stripCharacters($listId);

        return $this->put("/List/$listId", $list->toArray());
    }

    /**
     * @throws HapiConnectionException
     * @throws HapiValidationException
     */
    public function validate(ListResource $list, array $severities = [])
    {
        $severities = $this->buildSeveritiesArray($severities);
        $validationResponse = $this->post('/List/$validate', $list->toArray());
        $this->checkValidationSeverity($validationResponse, $severities);

        return $validationResponse;
    }
}
