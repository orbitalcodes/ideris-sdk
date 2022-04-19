<?php


namespace Ideris\Model;

use Ideris\Classes\ModelItemBase;

/**
 * Class Update
 * @package Ideris\Model
 */
class Update extends ModelItemBase
{
    protected $attributeMap = [
        "descricao"      => "String",
        "descricaoLonga" => "String",
        "criticidade"    => "String",
        "data"           => "DateTime",
    ];
}