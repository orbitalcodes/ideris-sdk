<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class Imagem
 * @package Ideris\Model
 */
class Imagem extends ModelItemBase
{
    protected $attributeMap = [
        "urlImagem"    => "string",
        "imagemBase64" => "string",
    ];
}