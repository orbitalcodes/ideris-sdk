<?php


namespace Ideris\Model;

use Ideris\Classes\ModelCollectionBase;
use Ideris\Traits\Paginable;

class Updates extends ModelCollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Updates"   => Update::class,
    ];

    protected $attributeMap = [
        "Updates" => "Collection",
    ];
}