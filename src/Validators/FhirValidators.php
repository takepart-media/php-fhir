<?php

namespace Takepartdev\LaravelFhir\Validators;

use Takepartdev\LaravelFhir\Exceptions\GenericFhirValidationException;

trait FhirValidators
{
    /**
     * @throws GenericFhirValidationException
     */
    public function validateRegex(string $suspect, string $rule, string $parameterName = ''): bool
    {
        if (! preg_match($rule, $suspect)) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateInArray(string $suspect, array $rules, string $parameterName = ''): bool
    {
        if (! in_array($suspect, $rules)) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (in array) parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateInteger(int $suspect, string $operator, int $limit, string $parameterName = ''): bool
    {
        switch ($operator) {
            case '>':
                if ($suspect <= $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (integer >) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '<':
                if ($suspect >= $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (integer <) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '<=':
                if ($suspect > $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (integer <=) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '>=':
                if ($suspect < $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (integer >=) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            default:
                if (config('fhir.ignore_validations')) {
                    return false;
                }
                throw new GenericFhirValidationException('Invalid operator supplied during (integer default) validation: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateDecimal(float $suspect, string $operator, float $limit, string $parameterName = ''): bool
    {
        switch ($operator) {
            case '>':
                if ($suspect <= $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (decimal >) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '<':
                if ($suspect >= $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (decimal <) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '<=':
                if ($suspect > $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (decimal <=) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            case '>=':
                if ($suspect < $limit) {
                    if (config('fhir.ignore_validations')) {
                        return false;
                    }
                    throw new GenericFhirValidationException('Unable to validate (decimal >=) parameter: ' . $parameterName . ' | ' . $suspect);
                }
                break;
            default:
                if (config('fhir.ignore_validations')) {
                    return false;
                }
                throw new GenericFhirValidationException('Invalid operator supplied during (decimal default) validation: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateBase64(string $suspect, string $parameterName = ''): bool
    {
        if (base64_encode(base64_decode($suspect, true)) !== $suspect) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate base64 string: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateDateTime(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'([0-9]([0-9]([0-9][1-9]|[1-9]0)|[1-9]00)|[1-9]000)(-(0[1-9]|1[0-2])(-(0[1-9]|[1-2][0-9]|3[0-1])(T([01][0-9]|2[0-3]):[0-5][0-9]:([0-5][0-9]|60)(\.[0-9]{1,9})?)?)?(Z|(\+|-)((0[0-9]|1[0-3]):[0-5][0-9]|14:00)?)?)?'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) date time parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateTime(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'([01][0-9]|2[0-3]):[0-5][0-9]:([0-5][0-9]|60)(\.[0-9]{1,9})?'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) time parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateDate(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'([0-9]([0-9]([0-9][1-9]|[1-9]0)|[1-9]00)|[1-9]000)(-(0[1-9]|1[0-2])(-(0[1-9]|[1-2][0-9]|3[0-1]))?)?'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) date parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateCode(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'[^\s]+( [^\s]+)*'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) code parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateUri(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'\S*'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) uri parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateUrl(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'\S*'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) url parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateLanguage(string $suspect, string $parameterName = ''): bool
    {
        if (! preg_match(
            "'^[a-z]{2}(-[A-Z]{2})?$'", //en-UK
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) language parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateMarkdown(string $suspect, string $parameterName = ''): bool
    {
        if ($suspect == '') {
            return true;
        }

        if (! preg_match(
            "'^[\s\S]+$'",
            $suspect
        )) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate (regex) markdown parameter: ' . $parameterName . ' | ' . $suspect);
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateOneOfThese(string $oneOfWhich, string $parameterName = ''): bool
    {
        foreach ($this->values as $key => $value) {
            if (strstr($key, $oneOfWhich)) {
                if (config('fhir.ignore_validations')) {
                    return false;
                }
                throw new GenericFhirValidationException('Unable to validate "One of these" parameter: ' . $parameterName . ' | ' . $oneOfWhich);
            }
        }

        return true;
    }

    /**
     * @throws GenericFhirValidationException
     */
    public function validateBoolean($boolean, string $parameterName = ''): bool
    {
        if (! in_array($boolean, [1, 0, '1', '0', true, false, 'true', 'false'])) {
            if (config('fhir.ignore_validations')) {
                return false;
            }
            throw new GenericFhirValidationException('Unable to validate "boolean" parameter: ' . $parameterName . ' | ' . $boolean);
        }

        return true;
    }
}
