<?php

namespace Takepartdev\LaravelFhir\Connections;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Takepartdev\LaravelFhir\Connections\Services\BundleService;
use Takepartdev\LaravelFhir\Connections\Services\ConditionService;
use Takepartdev\LaravelFhir\Connections\Services\CoreService;
use Takepartdev\LaravelFhir\Connections\Services\EncounterService;
use Takepartdev\LaravelFhir\Connections\Services\ListService;
use Takepartdev\LaravelFhir\Connections\Services\MedicationService;
use Takepartdev\LaravelFhir\Connections\Services\MedicationStatementService;
use Takepartdev\LaravelFhir\Connections\Services\ObservationService;
use Takepartdev\LaravelFhir\Connections\Services\OrganizationService;
use Takepartdev\LaravelFhir\Connections\Services\PatientService;
use Takepartdev\LaravelFhir\Connections\Services\PractitionerService;
use Takepartdev\LaravelFhir\Connections\Services\QuestionnaireResponseService;
use Takepartdev\LaravelFhir\Connections\Services\QuestionnaireService;
use Takepartdev\LaravelFhir\Connections\Services\ResearchStudyService;
use Takepartdev\LaravelFhir\Connections\Services\ResearchSubjectService;
use Takepartdev\LaravelFhir\Connections\Services\ServerActionService;
use Takepartdev\LaravelFhir\Exceptions\HapiConnectionException;
use Takepartdev\LaravelFhir\Exceptions\HapiValidationException;

/**
 * Client used to send requests to the hapi server
 *
 * @property PatientService $patients
 * @property BundleService $bundles
 * @property ConditionService $conditions
 * @property EncounterService $encounters
 * @property ObservationService $observations
 * @property OrganizationService $organizations
 * @property PractitionerService $practitioners
 * @property QuestionnaireService $questionnaires
 * @property QuestionnaireResponseService $questionnaireResponses
 * @property ServerActionService $serverAction
 * @property ResearchStudyService $researchStudies
 * @property ResearchSubjectService $researchSubjects
 * @property MedicationService $medications
 * @property MedicationStatementService $medicationStatements
 * @property ListService $lists
 */
class Hapi
{
    protected PendingRequest $hapiConnection;

    private ?CoreService $coreService = null;

    private string $baseUrl;

    private array $options;

    public function __construct(string $baseUrl, array $options = [])
    {
        $this->baseUrl = $baseUrl;
        $this->options = $options;

        $this->hapiConnection = Http::baseUrl($this->baseUrl);

        if (! request()->isSecure()) {
            $this->hapiConnection->withOptions(['verify' => false]);
        }

        if (isset($options['basic_auth_username']) && isset($options['basic_auth_password'])) {
            $this->hapiConnection->withBasicAuth($options['basic_auth_username'], $options['basic_auth_password']);
        }

        $this->hapiConnection->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * @throws HapiConnectionException
     */
    public function __get(string $name)
    {
        if ($this->coreService === null) {
            $this->coreService = new CoreService($this->baseUrl, $this->options);
        }

        return $this->coreService->__get($name);
    }

    protected function stripCharacters($string): array|string|null
    {
        return preg_replace('/[^0-9.]+/', '', $string);
    }

    protected function getOrderQuery(?string $orderByField = null, ?string $orderByDirection = null): string
    {
        $ordering = '';
        if ($orderByField) {
            if (! $orderByDirection) {
                $orderByDirection = ''; //ASC
            }
            $orderByDirection = $orderByDirection == '-' ? '-' : '';
            $ordering = "_sort=$orderByDirection$orderByField";
        }

        return $ordering;
    }

    protected function isValidParameter(string $parameter): false|int
    {
        return preg_match("'^[a-zA-Z0-9_:\-]+$'", $parameter);
    }

    protected function getOptionsQuery(array $options = []): string
    {
        $query = '';
        foreach ($options as $key => $option) {
            if ($this->isValidParameter($key)) {
                $query .= "&$key=$option";
            }
        }

        return $query;
    }

    /**
     * @throws HapiConnectionException
     */
    protected function get(string $url, ?string $orderByField = null, ?string $orderByDirection = null, array $options = [])
    {
        $ordering = $this->getOrderQuery($orderByField, $orderByDirection);
        $options = $this->getOptionsQuery($options);

        try {
            $response = $this->hapiConnection->get("$url?$ordering$options");
            if ($response->status() !== 200) {
                throw new HapiConnectionException("Something went wrong while accessing hapi with url: (GET) $url. Message: {$response->body()}");
            }

            return $response->json();
        } catch (\Exception $ex) {
            throw new HapiConnectionException($ex->getMessage());
        }
    }

    /**
     * @throws HapiConnectionException
     */
    protected function post(string $url, array $data = [])
    {
        try {
            $response = $this->hapiConnection->post($url, $data);
            if (! in_array($response->status(), [200, 201])) {
                throw new HapiConnectionException("Something went wrong while accessing hapi with url: (POST) $url. Message: {$response->body()}");
            }

            return $response->json();
        } catch (\Exception $ex) {
            throw new HapiConnectionException($ex->getMessage());
        }
    }

    /**
     * @throws HapiConnectionException
     */
    protected function put(string $url, array $data = [])
    {
        try {
            $response = $this->hapiConnection->put($url, $data);
            if ($response->status() !== 200) {
                throw new HapiConnectionException("Something went wrong while accessing hapi with url: (PUT) $url. Message: {$response->body()}");
            }

            return $response->json();
        } catch (\Exception $ex) {
            throw new HapiConnectionException($ex->getMessage());
        }
    }

    /**
     * @throws HapiConnectionException
     */
    protected function delete(string $url)
    {
        try {
            $response = $this->hapiConnection->delete($url);
            if ($response->status() !== 200) {
                throw new HapiConnectionException("Something went wrong while accessing hapi with url: (DELETE) $url. Message: {$response->body()}");
            }

            return $response->json();
        } catch (\Exception $ex) {
            throw new HapiConnectionException($ex->getMessage());
        }
    }

    /**
     * @throws HapiValidationException
     */
    protected function buildSeveritiesArray(array $severities): array
    {
        $allowedSeverities = ['error', 'warning', 'information'];
        foreach ($severities as $severity) {
            if (! in_array($severity, $allowedSeverities)) {
                throw new HapiValidationException("Unknown severity $severity");
            }
        }
        if (! in_array('error', $severities)) {
            $severities[] = 'error';
        }

        return $severities;
    }

    /**
     * @throws HapiValidationException
     */
    protected function checkValidationSeverity($validationResponse, array $severities): void
    {
        if (! is_array($validationResponse)) {
            throw new HapiValidationException("Unable to validate resource using Hapi's built in validator");
        }

        if (! isset($validationResponse['issue'])) {
            return;
        }

        $issues = [];
        foreach ($validationResponse['issue'] as $issue) {
            if (isset($issue['severity']) && in_array($issue['severity'], $severities)) {
                $severity = $issue['severity'];
                $issues[] = $issue['diagnostics'] ?? "Fatal validation message of $severity severity.";
            }
        }
        if (count($issues) > 0) {
            throw new HapiValidationException(implode(' | ', $issues));
        }
    }
}
