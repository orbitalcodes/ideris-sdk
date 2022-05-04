<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class Ncm
 * @package Ideris\Model
 */
class Ncm extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
        "codigo"    => "string",
    ];
}