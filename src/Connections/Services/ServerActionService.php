<?php

namespace Takepartdev\LaravelFhir\Connections\Services;

use Takepartdev\LaravelFhir\Connections\Hapi;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Resources\BundleResource;

class ServerActionService extends Hapi
{
    /**
     * @throws HapiConnectionException
     */
    public function createBundleTransaction(BundleResource $bundle)
    {
        return $this->post('/', $bundle->toArray());
    }
}
