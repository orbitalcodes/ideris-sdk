<?php


namespace Ideris\Models;

use Ideris\Classes\ModelItemBase;

/**
 * Class Update
 * @package Ideris\Model
 */
class Atualizacao extends ModelItemBase
{
    protected $attributeMap = [
        "descricao"      => "string",
        "descricaoLonga" => "string",
        "criticidade"    => "string",
        "data"           => "DateTime",
    ];
}