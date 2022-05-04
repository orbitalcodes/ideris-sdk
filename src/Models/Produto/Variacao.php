<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;

/**
 * Class Variacao
 * @package Ideris\Model
 */
class Variacao extends ModelItemBase
{
    protected $attributeMap = [
        "skuVariacao"        => 'string',
        "quantidadeVariacao" => 'int',
        "nomeAtributo"       => 'string',
        "valorAtributo"      => 'string',
        "Imagem"             => Imagem::class,
    ];
}