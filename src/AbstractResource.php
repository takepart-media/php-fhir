<?php

namespace Takepartdev\LaravelFhir;

use ReflectionClass;
use Takepartdev\LaravelFhir\DataTypes\PrependedPrimitive;
use Takepartdev\LaravelFhir\Validators\FhirValidators;

abstract class AbstractResource
{
    use FhirValidators;

    /**
     * Holds the data as a key => value array
     */
    protected array $values = [];

    /**
     * The name of the extended class/data type
     */
    protected string $name;

    /**
     * Constructor
     *
     * @param  array|null  $options  Data as key => value array
     */
    public function __construct(?array $options = null)
    {
        if (is_array($options)) {
            foreach ($options as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    /**
     * __set implementation
     */
    public function __set(string $name, $value)
    {
        $setValueMethod = "set{$name}";
        if (method_exists($this, $setValueMethod)) {
            $this->$setValueMethod($value);
        }

        $underscoreMethod = explode('_', $name);
        if (
            isset($underscoreMethod[1]) &&
            method_exists($this, "set{$underscoreMethod[1]}") &&
            $value instanceof PrependedPrimitive
        ) {
            $this->values[$name] = $value;
        }
    }

    /**
     * __get implementation
     *
     * @return mixed|null
     */
    public function &__get($name)
    {
        $nullValue = null;

        if (isset($this->values[$name])) {
            return $this->values[$name];
        }

        $setterMethodName = "set{$name}";
        $reflectionClass = new ReflectionClass($this);
        if ($reflectionClass->hasMethod($setterMethodName)) {
            $reflectionNamedType = $reflectionClass->getMethod($setterMethodName)->getParameters()[0]->getType();
            /* @var $reflectionNamedType ReflectionNamedType */
            if ($reflectionNamedType !== null) {
                $parameterClassName = $reflectionNamedType->getName();

                if (class_exists($parameterClassName)) {
                    $this->$setterMethodName(new $parameterClassName);

                    return $this->values[$name];
                }
            }
        }

        return $nullValue;
    }

    /**
     * __isset implementation
     *
     * @return bool
     */
    public function __isset($name)
    {
        return $this->__get($name) !== null;
    }

    /**
     * Recursive algorithm to convert complex types to an array
     */
    protected function convertToArray(array $arrayValues, bool $ignoreHiddenProperties = true): array
    {
        $returnArray = [];

        foreach ($arrayValues as $key => $value) {
            if ($ignoreHiddenProperties && $key === 'hiddenProperties') {
                continue;
            }
            if ($value instanceof self) {
                $returnArray[$key] = $value->toArray();
            } elseif (is_array($value)) {
                $returnArray[$key] = $this->convertToArray($value);
            } else {
                $returnArray[$key] = $value;
            }
        }

        return $returnArray;
    }

    /**
     * Returns the complex type as an array
     */
    public function toArray(bool $ignoreHiddenProperties = true): array
    {
        return $this->convertToArray($this->values, $ignoreHiddenProperties);
    }

    public function initArrayProperty(string $propertyName): void
    {
        if (
            ! isset($this->values[$propertyName]) ||
            ! is_array($this->values[$propertyName])
        ) {
            $this->values[$propertyName] = [];
        }
    }

    public function toJson(): false|string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function setResourceType(): void
    {
        $this->values['resourceType'] = $this->name;
    }

    public function setId(string $id): void
    {
        $this->values['id'] = $id;
    }

    public function getResourceName(): string
    {
        return $this->name;
    }

    public function setPrependedPrimitive(string $name, $value, bool $isArray = false): void
    {
        $underscoreMethod = explode('_', $name);
        if (
            isset($underscoreMethod[1]) &&
            method_exists($this, "set{$underscoreMethod[1]}") &&
            $value instanceof PrependedPrimitive
        ) {
            if ($isArray) {
                $this->initArrayProperty($name);
                $this->values[$name][] = $value;
            } else {
                $this->values[$name] = $value;
            }
        }
    }
}
