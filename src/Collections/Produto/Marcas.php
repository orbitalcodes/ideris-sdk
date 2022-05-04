<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Marca;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Marcas extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Marcas" => Marca::class,
    ];

    protected $attributeMap = [
        "Marcas" => Collection::class,
    ];
}