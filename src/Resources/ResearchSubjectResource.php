<?php

namespace Takepartdev\LaravelFhir\Resources;

use Takepartdev\LaravelFhir\AbstractResource;
use Takepartdev\LaravelFhir\DataTypes\CodeableReference;
use Takepartdev\LaravelFhir\DataTypes\Extension;
use Takepartdev\LaravelFhir\DataTypes\Identifier;
use Takepartdev\LaravelFhir\DataTypes\Meta;
use Takepartdev\LaravelFhir\DataTypes\Narrative;
use Takepartdev\LaravelFhir\DataTypes\Period;
use Takepartdev\LaravelFhir\DataTypes\Reference;
use Takepartdev\LaravelFhir\DataTypes\ResearchSubject\SubjectMilestone;
use Takepartdev\LaravelFhir\DataTypes\ResearchSubject\SubjectState;
use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

class ResearchSubjectResource extends AbstractResource
{
    protected string $name = 'ResearchSubject';

    public const string STATUS_DRAFT = 'draft';

    public const string STATUS_ACTIVE = 'active';

    public const string STATUS_RETIRED = 'retired';

    public const string STATUS_UNKNOWN = 'unknown';

    public const string STATUS_ACTIVE_V4 = 'eligible';

    public const string STATUS_RETIRED_V4 = 'withdrawn';

    public const array STATUS_CODES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_RETIRED,
        self::STATUS_UNKNOWN,
        self::STATUS_ACTIVE_V4,
        self::STATUS_RETIRED_V4,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setResourceType();
    }

    public function setId(string $id): void
    {
        $this->values['id'] = $id;
    }

    public function setMeta(Meta $meta): void
    {
        $this->values['meta'] = $meta;
    }

    public function setImplicitRules(string $implicitRules): void
    {
        $this->values['implicitRules'] = $implicitRules;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setLanguage(string $language): void
    {
        if ($this->validateLanguage($language, 'Patient.language')) {
            $this->values['language'] = $language;
        } else {
            $this->values['hiddenProperties']['language'] = $language;
        }
    }

    public function setText(Narrative $text): void
    {
        $this->values['text'] = $text;
    }

    public function setContained(array $contained): void
    {
        $this->initArrayProperty('contained');
        $this->values['contained'][] = $contained;
    }

    public function setExtension(Extension $extension): void
    {
        $this->values['extension'] = $extension;
    }

    public function setModifierExtension(Extension $modifierExtension): void
    {
        $this->initArrayProperty('modifierExtension');
        $this->values['modifierExtension'][] = $modifierExtension;
    }

    public function setIdentifier(Identifier $identifier): void
    {
        $this->initArrayProperty('identifier');
        $this->values['identifier'][] = $identifier;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function setStatus(string $code): void
    {
        if ($this->validateInArray($code, self::STATUS_CODES, "$this->name.status")) {
            $this->values['status'] = $code;
        } else {
            $this->values['hiddenProperties']['status'] = $code;
        }
    }

    public function setPeriod(Period $period): void
    {
        $this->values['period'] = $period;
    }

    public function setStudy(Reference $study): void
    {
        $this->values['study'] = $study;
    }

    public function setSubject(Reference $subject): void
    {
        $this->values['subject'] = $subject;
    }

    public function setSubjectV4(Reference $subject): void
    {
        $this->values['individual'] = $subject;
    }

    public function setSubjectState(SubjectState $subjectState): void
    {
        $this->initArrayProperty('subjectState');
        $this->values['subjectState'][] = $subjectState;
    }

    public function setSubjectMilestone(SubjectMilestone $subjectMilestone): void
    {
        $this->initArrayProperty('subjectMilestone');
        $this->values['subjectMilestone'][] = $subjectMilestone;
    }

    public function setComparisonGroup(CodeableReference $codeableReference): void
    {
        $this->initArrayProperty('comparisonGroup');
        $this->values['comparisonGroup'][] = $codeableReference;
    }

    public function setConsent(Reference $consent): void
    {
        $this->initArrayProperty('consent');
        $this->values['consent'][] = $consent;
    }
}
