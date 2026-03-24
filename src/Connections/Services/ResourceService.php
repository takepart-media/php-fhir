<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;

abstract class ResourceService extends Hapi
{
    abstract protected function resourceName(): string;

    /**
     * @throws HapiConnectionException
     */
    public function all(?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        return $this->get('/' . $this->resourceName(), $orderByField, $orderByDirection, $options);
    }

    /**
     * @throws HapiConnectionException
     */
    public function retrieve(string $id)
    {
        $id = $this->stripCharacters($id);

        return $this->get('/' . $this->resourceName() . "/$id");
    }

    /**
     * @throws HapiConnectionException
     */
    public function destroy(string $id)
    {
        $id = $this->stripCharacters($id);

        return $this->delete('/' . $this->resourceName() . "/$id");
    }
}
