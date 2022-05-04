<?php


namespace Ideris\Collections;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Marketplace;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Marketplaces extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Marketplaces" => Marketplace::class,
    ];

    protected $attributeMap = [
        "Marketplaces" => Collection::class,
    ];
}