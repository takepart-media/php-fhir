<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\Annotation;
use Takepartdev\LaravelFhir\DataTypes\CodeableConcept;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\MedicationList\ListEntry;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ListResource extends AbstractResource
{
    protected string $name = 'List';

    public const string STATUS_CURRENT = 'current';

    public const string STATUS_RETIRED = 'retired';

    public const string STATUS_ENTERED_IN_ERROR = 'entered-in-error';

    public const array STATUSES = [
        self::STATUS_CURRENT,
        self::STATUS_RETIRED,
        self::STATUS_ENTERED_IN_ERROR,
    ];

    public const string MODE_WORKING = 'working';

    public const string MODE_SNAPSHOT = 'snapshot';

    public const string MODE_CHANGES = 'changes';

    public const array MODES = [
        self::MODE_WORKING,
        self::MODE_SNAPSHOT,
        self::MODE_CHANGES,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $status): void
    {
        if ($this->validateInArray($status, self::STATUSES, "$this->name.status")) {
            $this->values['status'] = $status;
        } else {
            $this->values['hiddenProperties']['status'] = $status;
        }
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setMode(string $mode): void
    {
        if ($this->validateInArray($mode, self::MODES, "$this->name.mode")) {
            $this->values['mode'] = $mode;
        } else {
            $this->values['hiddenProperties']['mode'] = $mode;
        }
    }

    public function setTitle(string $title): void
    {
        $this->values['title'] = $title;
    }

    public function setCode(CodeableConcept $code): void
    {
        $this->values['code'] = $code;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setEncounter(Reference $encounter): void
    {
        $this->values['encounter'] = $encounter;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setDate(string $date): void
    {
        if ($this->validateDateTime($date, "$this->name.date")) {
            $this->values['date'] = $date;
        } else {
            $this->values['hiddenProperties']['date'] = $date;
        }
    }

    public function setSource(Reference $source): void
    {
        $this->values['source'] = $source;
    }

    public function setOrderedBy(CodeableConcept $orderedBy): void
    {
        $this->values['orderedBy'] = $orderedBy;
    }

    public function setNote(Annotation $note): void
    {
        $this->initArrayProperty('note');
        $this->values['note'][] = $note;
    }

    public function setEntry(ListEntry $entry): void
    {
        $this->initArrayProperty('entry');
        $this->values['entry'][] = $entry;
    }

    public function setEmptyReason(CodeableConcept $emptyReason): void
    {
        $this->values['emptyReason'] = $emptyReason;
    }
}
