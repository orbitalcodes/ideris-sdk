<?php

namespace Ideris\Classes;


abstract class ModelItemBase
{
    use TraitModelBase;

    /**
     * @param array|\StdClass $data
     */
    public function __construct($data = null)
    {
        if ($data) {
            foreach ($this->getAttributeMap() as $attribute => $type) {
                if (is_object($data))
                    $this->{$attribute} = $data->{$attribute} ?? null;
                elseif (is_array($data))
                    $this->{$attribute} = $data[$attribute] ?? null;
            }
        }
    }

    public function toArray(): array
    {
        $values = [];

        foreach ($this->attributeValues as $key => $attributeValue) {
            if ($attributeValue instanceof Collection || $attributeValue instanceof ModelItemBase)
                $values[$key] = $attributeValue->toArray();
            elseif ($attributeValue instanceof \DateTime)
                $values[$key] = $attributeValue->format('Y-m-d');
            else
                $values[$key] = $attributeValue;
        }

        return $values;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}