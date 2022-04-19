<?php


namespace Ideris\Model;

use Ideris\Classes\ModelCollectionBase;
use Ideris\Traits\Paginable;

class Statuses extends ModelCollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Statuses"   => Status::class,
    ];

    protected $attributeMap = [
        "Statuses" => "Collection",
    ];
}