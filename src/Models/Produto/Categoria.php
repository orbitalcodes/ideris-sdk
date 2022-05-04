<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class Categoria
 * @package Ideris\Model
 */
class Categoria extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
    ];
}