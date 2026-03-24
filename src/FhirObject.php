<?php

namespace Takepartdev\LaravelFhir;

use Illuminate\Support\Str;
use ReflectionException;
use Takepartdev\LaravelFhir\DataTypes\PrependedPrimitive;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\Resources\BundleResource;
use Takepartdev\LaravelFhir\Resources\EncounterResource;
use Takepartdev\LaravelFhir\Resources\ListResource;
use Takepartdev\LaravelFhir\Resources\MedicationResource;
use Takepartdev\LaravelFhir\Resources\MedicationStatementResource;
use Takepartdev\LaravelFhir\Resources\ObservationResource;
use Takepartdev\LaravelFhir\Resources\OrganizationResource;
use Takepartdev\LaravelFhir\Resources\PatientResource;
use Takepartdev\LaravelFhir\Resources\PractitionerResource;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResource;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResponseResource;
use Takepartdev\LaravelFhir\Resources\ResearchStudyResource;
use Takepartdev\LaravelFhir\Resources\ResearchSubjectResource;
use Takepartdev\LaravelFhir\Resources\ServiceRequestResource;

class FhirObject
{
    public AbstractResource $returnValue;

    public const array MAIN_RESOURCES = [
        'Patient' => PatientResource::class,
        'Bundle' => BundleResource::class,
        'Organization' => OrganizationResource::class,
        'Encounter' => EncounterResource::class,
        'Practitioner' => PractitionerResource::class,
        'Questionnaire' => QuestionnaireResource::class,
        'QuestionnaireResponse' => QuestionnaireResponseResource::class,
        'ServiceRequest' => ServiceRequestResource::class,
        'Observation' => ObservationResource::class,
        'ResearchStudy' => ResearchStudyResource::class,
        'ResearchSubject' => ResearchSubjectResource::class,
        'Medication' => MedicationResource::class,
        'MedicationStatement' => MedicationStatementResource::class,
        'List' => ListResource::class,
    ];

    /**
     * @throws GenericFhirValidationException|ReflectionException
     */
    public function __construct(array $data)
    {
        $this->returnValue = $this->build($data['resourceType'], $data);
    }

    public function toFhir(): AbstractResource
    {
        return $this->returnValue;
    }

    private static array $setterTypeCache = [];

    private function getSetterParamType(string $class, string $setter): ?string
    {
        $cacheKey = $class . '::' . $setter;
        if (! array_key_exists($cacheKey, self::$setterTypeCache)) {
            $ref = new \ReflectionClass($class);
            if (! $ref->hasMethod($setter)) {
                self::$setterTypeCache[$cacheKey] = null;
            } else {
                $params = $ref->getMethod($setter)->getParameters();
                self::$setterTypeCache[$cacheKey] = isset($params[0]) ? $params[0]->getType()?->getName() : null;
            }
        }

        return self::$setterTypeCache[$cacheKey];
    }

    /**
     * @throws GenericFhirValidationException
     * @throws ReflectionException
     */
    private function build(string $resourceType, array $data): AbstractResource
    {
        if (isset($data['resourceType'])) {
            $resourceType = $data['resourceType'];
        }

        if (isset(self::MAIN_RESOURCES[$resourceType])) {
            $class = self::MAIN_RESOURCES[$resourceType];
            $fhirResource = new $class;
        } else {
            $fhirResource = new $resourceType;
        }

        foreach ($data as $key => $value) {

            $prepended = false;
            $setter = 'set' . Str::title($key);

            if (Str::startsWith($key, '_')) {
                $prepended = true;
                $setter = 'setPrependedPrimitive';
            }

            if (is_string($value) || is_bool($value) || is_int($value) || is_float($value)) {
                $fhirResource->$setter($value);

                continue;
            }

            if ($key === 'contained') {
                foreach ($value as $item) {
                    $fhirResource->setContained($item);
                }

                continue;
            }

            if (isset($value[0])) {
                foreach ($value as $subValue) {
                    if (is_string($subValue)) {
                        $fhirResource->$setter($subValue);

                        continue;
                    }

                    if ($prepended) {
                        $meta = $this->build(PrependedPrimitive::class, $subValue);
                        $fhirResource->setPrependedPrimitive($key, $meta, true);
                    } else {
                        $fhirParamType = $this->getSetterParamType($fhirResource::class, $setter);
                        if ($fhirParamType === null) {
                            continue;
                        }
                        $meta = $this->build($fhirParamType, $subValue);
                        $fhirResource->$setter($meta);
                    }
                }
            } else {
                if ($prepended) {
                    $meta = $this->build(PrependedPrimitive::class, $value);
                    $fhirResource->setPrependedPrimitive($key, $meta);
                } else {
                    $fhirParamType = $this->getSetterParamType($fhirResource::class, $setter);
                    if ($fhirParamType === null) {
                        continue;
                    }
                    $meta = $this->build($fhirParamType, $value);
                    $fhirResource->$setter($meta);
                }
            }
        }

        return $fhirResource;
    }
}
