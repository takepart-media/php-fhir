<?php

namespace Takepartdev\LaravelFhir\Connections\Services\Snomed;

use Takepartdev\LaravelFhir\Connections\Snomed;
use Takepartdev\LaravelFhir\Exceptions\SnomedConnectionException;

class ValueSetService extends Snomed
{
    /**
     * @throws SnomedConnectionException
     */
    public function find(string $needle, int $count = 10)
    {
        return $this->get('/ValueSet/$expand', [
            'url' => 'http://snomed.info/sct?fhir_vs',
            'filter' => $needle,
        ], $count);
    }
}
