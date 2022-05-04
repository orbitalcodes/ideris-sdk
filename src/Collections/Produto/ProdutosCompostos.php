<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\ProdutoComposto;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class ProdutosCompostos extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "ProdutosCompostos" => ProdutoComposto::class,
    ];

    protected $attributeMap = [
        "ProdutosCompostos" => Collection::class,
    ];
}