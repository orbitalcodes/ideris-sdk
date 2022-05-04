<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Origem;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Origens extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Origens" => Origem::class,
    ];

    protected $attributeMap = [
        "Origens" => Collection::class,
    ];
}