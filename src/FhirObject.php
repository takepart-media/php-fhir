<?php

namespace Takepartdev\LaravelFhir;

use Illuminate\Support\Str;
use ReflectionException;
use Takepartdev\LaravelFhir\DataTypes\PrependedPrimitive;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;
use Takepartdev\LaravelFhir\Resources\BundleResource;
use Takepartdev\LaravelFhir\Resources\EncounterResource;
use Takepartdev\LaravelFhir\Resources\ObservationResource;
use Takepartdev\LaravelFhir\Resources\OrganizationResource;
use Takepartdev\LaravelFhir\Resources\PatientResource;
use Takepartdev\LaravelFhir\Resources\PractitionerResource;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResource;
use Takepartdev\LaravelFhir\Resources\QuestionnaireResponseResource;
use Takepartdev\LaravelFhir\Resources\ServiceRequestResource;

class FhirObject
{
    public AbstractResource|PatientResource|BundleResource|OrganizationResource|EncounterResource|PractitionerResource|QuestionnaireResource|QuestionnaireResponseResource|ServiceRequestResource|ObservationResource $returnValue;

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
    ];

    /**
     * @throws GenericFhirValidationException|ReflectionException
     */
    public function __construct(array $data)
    {
        $this->returnValue = $this->build($data['resourceType'], $data);
    }

    public function toFhir(): AbstractResource|PatientResource|BundleResource|OrganizationResource|EncounterResource|PractitionerResource|QuestionnaireResource|QuestionnaireResponseResource|ServiceRequestResource|ObservationResource
    {
        return $this->returnValue;
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

        $reflectionClass = new \ReflectionClass($fhirResource::class);

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

            $method = $reflectionClass->getMethod($setter);
            $parameter = $method->getParameters()[0];

            if (isset($value[0])) {
                foreach ($value as $subValue) {
                    if (is_string($subValue)) {
                        $fhirResource->$setter($subValue);

                        continue;
                    }

                    if ($prepended) {
                        $fhirParamType = PrependedPrimitive::class;
                        $meta = $this->build($fhirParamType, $subValue);
                        $fhirResource->setPrependedPrimitive($key, $meta, true);
                    } else {
                        $fhirParamType = $parameter->getType()->getName();
                        $meta = $this->build($fhirParamType, $subValue);
                        $fhirResource->$setter($meta);
                    }
                }
            } else {
                if ($prepended) {
                    $fhirParamType = PrependedPrimitive::class;
                    $meta = $this->build($fhirParamType, $value);
                    $fhirResource->setPrependedPrimitive($key, $meta);
                } else {
                    $fhirParamType = $parameter->getType()->getName();
                    $meta = $this->build($fhirParamType, $value);
                    $fhirResource->$setter($meta);
                }
            }
        }

        return $fhirResource;
    }
}
