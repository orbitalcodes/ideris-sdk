<?php

namespace Tests;

use Ideris\Models\Produto\Imagem;
use Ideris\Models\Produto\Produto;
use Ideris\Models\Protocolo;

class ProdutoTest extends TestCaseApi
{
    public function testCreateRandomSimpleProduto(): array
    {
        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    public function testCreateRandomProdutoVariacao(): array
    {
        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $produtoModel->setVariacao([
            [
                "skuVariacao"        => $this->faker()->regexify('[A-Z]{5}[0-4]{3}'),
                "quantidadeVariacao" => $this->faker()->randomNumber(3, true),
                "nomeAtributo"       => $this->faker()->word(),
                "valorAtributo"      => $this->faker()->randomFloat(1, 51, 100),
                "Imagem"             => [
                    ['imagemBase64' => $this->getImagemBase64Faker()]
                ]
            ]
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    /**
     * @depends testCreateRandomSimpleProduto
     */
    public function testCreateRandomProdutoComposto(array $result): array
    {
        sleep(10); //Esperando o produto simples confirmar cadastro

        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $produtoModel->setProdutoComposto([
            [
                "skuProdutoFilho" => $result['produtoModel']->sku,
                "quantidade"      => $this->faker()->randomNumber(3, true),
            ]
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    protected function prepareDadosProduto(): Produto
    {
        $categoria = $this->getIderisSdk()->categoria()->get('Geral')->first();
        $subcategoria = $this->getIderisSdk()->subCategoria()->get('Geral')->first();
        $marca = $this->getIderisSdk()->marca()->get('Geral')->first();
        $departamento = $this->getIderisSdk()->departamento()->get('Geral')->first();
        $produtoOrigem = $this->getIderisSdk()->origem()->get()->first();
        $ncm = $this->getIderisSdk()->ncm()->getByCode(NcmTest::$ncmCodigoStatic);

        return new Produto([
            "sku"                        => $this->faker()->regexify('[A-Z]{5}[0-4]{3}'),
            "titulo"                     => $this->faker()->words(2, true),
            "descricaoLonga"             => $this->faker()->sentence(),
//            "categoriaML"                => 'string',
            "categoriaIdIderis"          => $categoria->id,
            "subCategoriaIdIderis"       => $subcategoria->id,
            "marcaIdIderis"              => $marca->id,
            "departamentoIdIderis"       => $departamento->id,
            "ncmId"                      => $ncm->id,
            "produtoOrigemId"            => $produtoOrigem->id,
            "modelo"                     => $this->faker()->word(),
            "garantia"                   => $this->faker()->sentence(),
//            "videoYoutube"               => 'string',
            "peso"                       => $this->faker()->randomFloat(1, 0.1, 10),
            "comprimento"                => $this->faker()->randomFloat(1, 10, 50),
            "largura"                    => $this->faker()->randomFloat(1, 10, 50),
            "altura"                     => $this->faker()->randomFloat(1, 10, 50),
            "pesoEmbalagem"              => $this->faker()->randomFloat(1, 0.1, 1),
            "comprimentoEmbalagem"       => $this->faker()->randomFloat(1, 10, 50),
            "larguraEmbalagem"           => $this->faker()->randomFloat(1, 10, 50),
            "alturaEmbalagem"            => $this->faker()->randomFloat(1, 10, 50),
            "cest"                       => $this->faker()->word(),
            "ean"                        => $this->faker()->ean13(),
            "valorCusto"                 => $this->faker()->randomFloat(1, 10, 50),
            "valorVenda"                 => $this->faker()->randomFloat(1, 51, 100),
            "dataValidade"               => $this->faker()->date(),
            "quantidadeEstoquePrincipal" => $this->faker()->randomNumber(3, true),
        ]);
    }

    protected function getImagemBase64Faker(): string
    {
        $imageRandom = $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png';
        $data = file_get_contents($imageRandom);
        return 'type:image/png;base64:' . base64_encode($data);
    }
}