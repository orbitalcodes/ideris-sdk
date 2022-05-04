<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Departamento;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Departamentos extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Departamentos" => Departamento::class,
    ];

    protected $attributeMap = [
        "Departamentos" => Collection::class,
    ];
}