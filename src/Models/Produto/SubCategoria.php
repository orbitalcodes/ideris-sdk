<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class SubCategoria
 * @package Ideris\Model
 */
class SubCategoria extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
    ];
}