<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class ProdutoComposto
 * @package Ideris\Model
 */
class ProdutoComposto extends ModelItemBase
{
    protected $attributeMap = [
        "skuProdutoFilho" => "string",
        "quantidade"      => "int",
    ];
}