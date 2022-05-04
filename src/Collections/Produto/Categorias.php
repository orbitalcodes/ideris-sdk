<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Categoria;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Categorias extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Categorias" => Categoria::class,
    ];

    protected $attributeMap = [
        "Categorias" => Collection::class,
    ];
}