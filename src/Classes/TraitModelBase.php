<?php

namespace Ideris\Classes;


use Ideris\Helper\General;

trait TraitModelBase
{
    /**
     * @var \StdClass
     */
    protected $response;

    protected $attributeMap = [];

    protected $attributeValues = [];

    protected $itemAttributeModel = [];

    /**
     * @return array
     */
    public function getAttributeMap(): array
    {
        return $this->attributeMap;
    }

    /**
     * @param array $attributeMap
     */
    public function setAttributeMap(array $attributeMap): void
    {
        $this->attributeMap = $attributeMap;
    }

    public function __set($attribute, $value)
    {
        $attributeType = $this->attributeMap[$attribute] ?? null;

        if (class_exists($attributeType) && $value instanceof $attributeType)
            $this->attributeValues[$attribute] = $value;
        elseif (class_exists($attributeType))
            $this->attributeValues[$attribute] = new $attributeType($value);
        else
            $this->attributeValues[$attribute] = $value;
    }

    public function __get($attribute)
    {
        return $this->attributeValues[$attribute] ?? null;
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'get') === 0) {
            $attribute = ltrim($name, 'get');
            if (isset($this->attributeMap[General::snake_case($attribute)]))
                return $this->{General::snake_case($attribute)};
            else if (isset($this->attributeMap[\ucwords($attribute)]))
                return $this->{\ucwords($attribute)};
        }

        if (strpos($name, 'set') === 0) {
            $attribute = ltrim($name, 'set');
            $value = array_values($arguments);

            if (isset($this->attributeMap[General::snake_case($attribute)]))
                $this->{General::snake_case($attribute)} = array_shift($value);
            else if (isset($this->attributeMap[\ucwords($attribute)]))
                $this->{\ucwords($attribute)} = array_shift($value);
        }
    }

    /**
     * @return array
     */
    public function getItemAttributeModel(): array
    {
        return $this->itemAttributeModel;
    }

    /**
     * @param array $itemAttributeModel
     */
    public function setItemAttributeModel(array $itemAttributeModel): void
    {
        $this->itemAttributeModel = $itemAttributeModel;
    }
}