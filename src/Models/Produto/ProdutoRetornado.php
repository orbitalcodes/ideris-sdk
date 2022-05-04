<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;
use Ideris\Collections\Produto\Imagens;
use Ideris\Collections\Produto\ProdutosCompostos;
use Ideris\Collections\Produto\Variacoes;

/**
 * Class Produto
 * @package Ideris\Model
 */
class ProdutoRetornado extends ModelItemBase
{
    protected $attributeMap = [
        "id"                                => 'int',
        "sku"                               => 'string',
        "titulo"                            => 'string',
        "descricaoLonga"                    => 'string',
        "marcaId"                           => 'int',
        "marca"                             => 'string',
        "departamentoId"                    => 'int',
        "departamento"                      => 'string',
        "categoriaId"                       => 'int',
        "categoria"                         => 'string',
        "subCategoriaId"                    => 'int',
        "subCategoria"                      => 'string',
        "modelo"                            => 'string',
        "garantia"                          => 'string',
        "peso"                              => 'decimal',
        "comprimento"                       => 'decimal',
        "largura"                           => 'decimal',
        "altura"                            => 'decimal',
        "pesoEmbalagem"                     => 'decimal',
        "comprimentoEmbalagem"              => 'decimal',
        "larguraEmbalagem"                  => 'decimal',
        "alturaEmbalagem"                   => 'decimal',
        "ncmId"                             => 'int',
        "ncm"                               => 'string',
        "produtoOrigemId"                   => 'int',
        "produtoOrigem"                     => 'string',
        "cest"                              => 'string',
        "ean"                               => 'string',
        "tipoProdutoId"                     => 'int',
        "tipoProduto"                       => 'string',
        "caminhoImagem"                     => 'string',
        "videoYoutube"                      => 'string',
        "estoquePrincipalId"                => 'int',
        "quantidadeEstoquePrincipal"        => 'int',
        "quantidadeEstoquePrincipalReserva" => 'int',
        "valorCusto"                        => 'decimal',
        "valorVenda"                        => 'decimal',
        "ultimaAlteracaoPreco"              => \DateTime::class,
        "Variacao"                          => Variacoes::class,
        "ProdutoComposto"                   => ProdutosCompostos::class,
        "Imagens"                           => Imagens::class,
    ];
}