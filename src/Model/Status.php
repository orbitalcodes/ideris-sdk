<?php


namespace Ideris\Model;

use Ideris\Classes\ModelItemBase;

/**
 * Class Status
 * @package Ideris\Model
 */
class Status extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "Integer",
        "descricao" => "String",
        "modulo"    => "String",
    ];
}