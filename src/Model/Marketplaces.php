<?php


namespace Ideris\Model;

use Ideris\Classes\ModelCollectionBase;
use Ideris\Traits\Paginable;

class Marketplaces extends ModelCollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Marketplaces"   => Marketplace::class,
    ];

    protected $attributeMap = [
        "Marketplaces" => "Collection",
    ];
}