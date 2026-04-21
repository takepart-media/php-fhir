<?php

namespace Takepartdev\LaravelFhir\Connections;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Takepartdev\LaravelFhir\Connections\Services\Snomed\CoreService;
use Takepartdev\LaravelFhir\Exceptions\SnomedConnectionException;

class Snomed
{
    private ?CoreService $coreService = null;

    protected PendingRequest $snomedConnection;

    private string $baseUrl;

    public function __construct(?string $baseUrl)
    {
        if (! $baseUrl) {
            $baseUrl = config('fhir.snomed_test_url');
        }

        $this->baseUrl = $baseUrl;

        $this->snomedConnection = Http::baseUrl($this->baseUrl)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * @throws SnomedConnectionException
     */
    public function __get(string $name)
    {
        if ($this->coreService === null) {
            $this->coreService = new CoreService($this->baseUrl);
        }

        return $this->coreService->__get($name);
    }

    /**
     * @throws SnomedConnectionException
     */
    protected function get(string $url, array $query = [], int $count = 10)
    {
        $query['count'] = $count;

        try {
            $response = $this->snomedConnection->get($url, $query);
        } catch (ConnectionException $ex) {
            throw new SnomedConnectionException("Failed to reach snomed at (GET) $url: {$ex->getMessage()}", 0, $ex);
        }

        if ($response->status() !== 200) {
            throw new SnomedConnectionException("Something went wrong while accessing snomed with url: (GET) $url. Message: {$response->body()}");
        }

        return $response->json();
    }
}
