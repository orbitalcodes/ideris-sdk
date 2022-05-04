<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class Departamento
 * @package Ideris\Model
 */
class Departamento extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
    ];
}