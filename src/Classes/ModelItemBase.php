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

    public function toArray()
    {
        return $this->attributeValues;
    }
}