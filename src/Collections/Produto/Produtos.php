<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\ProdutoRetornado;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Produtos extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Produtos" => ProdutoRetornado::class,
    ];

    protected $attributeMap = [
        "Produtos" => Collection::class,
    ];
}