<?php

namespace Takepartdev\LaravelFhir\DataTypes;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class Extension extends AbstractResource
{
    protected string $name = 'Extension';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setUrl(string $uri): void
    {
        if ($this->validateUrl($uri, 'Extension.url')) {
            $this->values['url'] = $uri;
        } else {
            $this->values['hiddenProperties']['url'] = $uri;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueBase64Binary(string $base64String): void
    {
        if ($this->validateBase64($base64String, 'Extension.valueBase64Binary')) {
            $this->values['valueBase64Binary'] = $base64String;
        } else {
            $this->values['hiddenProperties']['valueBase64Binary'] = $base64String;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueBoolean($val): void
    {
        if ($this->validateBoolean($val, 'Extension.valueBoolean')) {
            $this->values['valueBoolean'] = $val;
        } else {
            $this->values['hiddenProperties']['valueBoolean'] = $val;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueCanonical(string $canonical): void
    {
        if ($this->validateUri($canonical, 'Extension.valueCanonical')) {
            $this->values['valueCanonical'] = $canonical;
        } else {
            $this->values['hiddenProperties']['valueCanonical'] = $canonical;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueCode(string $code): void
    {
        if ($this->validateCode($code, 'Extension.valueCode')) {
            $this->values['valueCode'] = $code;
        } else {
            $this->values['hiddenProperties']['valueCode'] = $code;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDate(string $dateString): void
    {
        if ($this->validateDate($dateString, 'Extension.valueDate')) {
            $this->values['valueDate'] = $dateString;
        } else {
            $this->values['hiddenProperties']['valueDate'] = $dateString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueDateTime(string $dateString): void
    {
        if ($this->validateDateTime($dateString, 'Extension.valueDateTime')) {
            $this->values['valueDateTime'] = $dateString;
        } else {
            $this->values['hiddenProperties']['valueDateTime'] = $dateString;
        }
    }

    public function setValueDecimal(float $decimal): void
    {
        $this->values['valueDecimal'] = $decimal;
    }

    public function setValueId(string $id): void
    {
        $this->values['valueId'] = $id;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueInstant(string $dateTimeString): void
    {
        if ($this->validateDateTime($dateTimeString, 'Extension.valueInstant')) {
            $this->values['valueInstant'] = $dateTimeString;
        } else {
            $this->values['hiddenProperties']['valueInstant'] = $dateTimeString;
        }
    }

    public function setValueInteger(int $val): void
    {
        $this->values['valueInteger'] = $val;
    }

    public function setValueInteger64(int $val): void
    {
        $this->values['valueInteger64'] = $val;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueMarkdown(string $markdown): void
    {
        if ($this->validateMarkdown($markdown, 'Extension.valueMarkdown')) {
            $this->values['valueMarkdown'] = $markdown;
        } else {
            $this->values['hiddenProperties']['valueMarkdown'] = $markdown;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueOid(string $oid): void
    {
        if ($this->validateRegex($oid, "'urn:oid:[0-2](\.(0|[1-9][0-9]*))+'", 'Extension.valueOID')) {
            $this->values['valueOid'] = $oid;
        } else {
            $this->values['hiddenProperties']['valueOid'] = $oid;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValuePositiveInt(int $posInt): void
    {
        if ($this->validateInteger($posInt, '>', 0, 'Extension.valuePositiveInt')) {
            $this->values['valuePositiveInt'] = $posInt;
        } else {
            $this->values['hiddenProperties']['valuePositiveInt'] = $posInt;
        }
    }

    public function setValueString(string $val): void
    {
        $this->values['valueString'] = $val;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueTime(string $timeString): void
    {
        if ($this->validateTime($timeString, 'Extension.valueTime')) {
            $this->values['valueTime'] = $timeString;
        } else {
            $this->values['hiddenProperties']['valueTime'] = $timeString;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueUnsignedInt(int $val): void
    {
        if ($this->validateInteger($val, '>=', 0, 'Extension.valueUnsignedInt')) {
            $this->values['valueUnsignedInt'] = $val;
        } else {
            $this->values['hiddenProperties']['valueUnsignedInt'] = $val;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueUri(string $uri): void
    {
        if ($this->validateUri($uri, 'Extension.valueUri')) {
            $this->values['valueUri'] = $uri;
        } else {
            $this->values['hiddenProperties']['valueUri'] = $uri;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueUrl(string $url): void
    {
        if ($this->validateUrl($url, 'Extension.valueUrl')) {
            $this->values['valueUrl'] = $url;
        } else {
            $this->values['hiddenProperties']['valueUrl'] = $url;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setValueUuid(string $uuid): void
    {
        if ($this->validateRegex($uuid, "'urn:uuid:[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'", 'Extension.valueUuid')) {
            $this->values['valueUuid'] = $uuid;
        } else {
            $this->values['hiddenProperties']['valueUuid'] = $uuid;
        }
    }

    public function setValueAddress(Address $address): void
    {
        $this->values['valueAddress'] = $address;
    }

    public function setValueAge($age): void
    {
        $this->values['valueAge'] = $age;
    }

    public function setAnnotation(Annotation $annotation): void
    {
        $this->values['annotation'] = $annotation;
    }

    public function setValueAttachment(Attachment $attachment): void
    {
        $this->values['valueAttachment'] = $attachment;
    }

    public function setValueCodeableConcept(CodeableConcept $cConcept): void
    {
        $this->values['valueCodeableConcept'] = $cConcept;
    }

    public function setValueCodeableReference(CodeableConcept $cReference): void
    {
        $this->values['valueCodeableReference'] = $cReference;
    }

    public function setValueCoding(Coding $coding): void
    {
        $this->values['valueCoding'] = $coding;
    }

    public function setValueContactPoint(ContactPoint $cPoint): void
    {
        $this->values['valueContactPoint'] = $cPoint;
    }

    public function setValueCount($count): void
    {
        $this->values['valueCount'] = $count;
    }

    public function setValueDistance($distance): void
    {
        $this->values['valueDistance'] = $distance;
    }

    public function setValueDuration($duration): void
    {
        $this->values['valueDuration'] = $duration;
    }

    public function setValueHumanName(HumanName $name): void
    {
        $this->values['valueHumanName'] = $name;
    }

    public function setValueIdentifier(Identifier $identifier): void
    {
        $this->values['valueIdentifier'] = $identifier;
    }

    public function setValueMoney(Money $money): void
    {
        $this->values['valueMoney'] = $money;
    }

    public function setValuePeriod(Period $period): void
    {
        $this->values['valuePeriod'] = $period;
    }

    public function setValueQuantity(Quantity $quantity): void
    {
        $this->values['valueQuantity'] = $quantity;
    }

    public function setValueRange(Range $range): void
    {
        $this->values['valueRange'] = $range;
    }

    public function setValueRatio(Ratio $ratio): void
    {
        $this->values['valueRatio'] = $ratio;
    }

    public function setValueRatioRange(RatioRange $ratioRange): void
    {
        $this->values['valueRatioRange'] = $ratioRange;
    }

    public function setValueReference(Reference $reference): void
    {
        $this->values['valueReference'] = $reference;
    }

    public function setValueSampledData(SampledData $sampledData): void
    {
        $this->values['valueSampledData'] = $sampledData;
    }

    public function setValueSignature(Signature $signature): void
    {
        $this->values['valueSignature'] = $signature;
    }

    public function setValueTiming(Timing $timing): void
    {
        $this->values['valueTiming'] = $timing;
    }

    public function setValueContactDetail(ContactDetail $contactDetail): void
    {
        $this->values['valueContactDetail'] = $contactDetail;
    }

    public function setValueDataRequirement(DataRequirement $dataRequirement): void
    {
        $this->values['valueDataRequirement'] = $dataRequirement;
    }

    public function setValueExpression(Expression $expression): void
    {
        $this->values['valueExpression'] = $expression;
    }

    public function setValueParameterDefinition(ParameterDefinition $parameterDefinition): void
    {
        $this->values['valueParameterDefinition'] = $parameterDefinition;
    }

    public function setValueRelatedArtifact(RelatedArtifact $relatedArtifact): void
    {
        $this->values['valueRelatedArtifact'] = $relatedArtifact;
    }

    public function setValueTriggerDefinition(TriggerDefinition $triggerDefinition): void
    {
        $this->values['valueTriggerDefinition'] = $triggerDefinition;
    }

    public function setValueUsageContext(UsageContext $usageContext): void
    {
        $this->values['valueUsageContext'] = $usageContext;
    }

    public function setValueAvailability(Availability $availability): void
    {
        $this->values['valueAvailability'] = $availability;
    }

    public function setValueExtendedContactDetail(ExtendedContactDetail $extendedContactDetail): void
    {
        $this->values['valueExtendedContactDetail'] = $extendedContactDetail;
    }

    public function setValueDosage(Dosage $dosage): void
    {
        $this->values['valueDosage'] = $dosage;
    }

    public function setValueMeta(Meta $meta): void
    {
        $this->values['valueMeta'] = $meta;
    }
}
