<?php

namespace Ideris\Classes;


abstract class CollectionBase extends Collection
{
    use TraitModelBase;

    public function __construct($response = null)
    {
        $this->response = $response;
        $result = null;

        if (is_object($this->response) && property_exists($this->response, 'result') && $this->response->result)
            $result = $this->response->result;
        elseif (is_object($this->response) && !property_exists($this->response, 'paging'))
            $result = $this->response;
        elseif (is_array($this->response))
            $result = $this->response;

        if ($result && is_array($result)) {
            foreach ($this->getAttributeMap() as $attribute => $type) {
                $modelClass = $this->getModelClassFromAttribute($attribute);
                if (class_exists($modelClass)) {
                    foreach ($result as $value) {
                        $this->push(new $modelClass($value));
                    }
                } else {
                    $this->{$attribute} = $result[$attribute];
                }
            }
        } else {
            parent::__construct([]);
        }
    }

    protected function getModelClassFromAttribute(string $attribute)
    {
        return $this->itemAttributeModel[$attribute] ?? '';
    }

    public function __get($attribute)
    {
        $modelClass = $this->getModelClassFromAttribute($attribute);
        if (class_exists($modelClass)) {
            return $this->whereInstanceOf($modelClass);
        } else {
            $value = $this->attributeValues[$attribute] ?? null;

            if (is_null($value)) {
                if (parent::has($attribute)) {
                    return parent::__get($attribute);
                }
            }

            return $value;
        }
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'get') === 0) {
            $attribute = ltrim($name, 'get');
            return $this->{$attribute};
        }
    }

    public function toArray()
    {
        $items = parent::toArray();
        $result = [];
        foreach ($items as $item) {
            if ($item instanceof ModelItemBase) {
                $result[] = $item->toArray();
            } else {
                $result[] = $item;
            }
        }

        return array_merge($result, $this->attributeValues);
    }
}