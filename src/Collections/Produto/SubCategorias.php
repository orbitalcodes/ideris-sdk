<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\SubCategoria;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class SubCategorias extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "SubCategorias" => SubCategoria::class,
    ];

    protected $attributeMap = [
        "SubCategorias" => Collection::class,
    ];
}