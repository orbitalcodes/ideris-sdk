<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\SubCategorias;
use Ideris\Models\Produto\SubCategoria;

class SubCategoriaTest extends TestCaseApi
{
    public function testCreateRandomSubCategoria(): void
    {
        $descricao = $this->faker()->words(2, true);

        $subCategoriaModel = new SubCategoria([
            'descricao' => $descricao,
        ]);

        $this->assertInstanceOf(SubCategoria::class, $subCategoriaModel);

        $subCategoriaReturned = $this->getIderisSdk()->subCategoria()->create($subCategoriaModel);

        $this->assertInstanceOf(SubCategoria::class, $subCategoriaReturned);
        $this->assertEquals($descricao, $subCategoriaReturned->descricao);

        $subCategoriaFinded = $this->getIderisSdk()->subCategoria()->getById($subCategoriaReturned->id);

        $this->assertInstanceOf(SubCategoria::class, $subCategoriaFinded);
        $this->assertEquals($descricao, $subCategoriaFinded->descricao);
    }

    /**
     * @depends testCreateRandomSubCategoria
     */
    public function testGetSubCategorias(): void
    {
        $subCategorias = $this->getIderisSdk()->subCategoria()->get();

        $this->assertInstanceOf(SubCategorias::class, $subCategorias);
        $this->assertInstanceOf(Collection::class, $subCategorias);
        $this->assertInstanceOf(SubCategoria::class, $subCategorias->first());
    }

    /**
     * @depends testCreateRandomSubCategoria
     */
    public function testGetSubCategoriasPaginate(): void
    {
        $subCategorias = $this->getIderisSdk()->subCategoria()->get();

        $this->assertEquals(0, $subCategorias->getOffset());
        $this->assertTrue($subCategorias->getCount() <= $subCategorias->getLimit());
    }

    /**
     * @depends testCreateRandomSubCategoria
     */
    public function testGetSubCategoriasOffsetLimit(): void
    {
        $subCategorias = $this->getIderisSdk()->subCategoria()->get(null, 1, 5);

        $this->assertEquals(1, $subCategorias->getOffset());
        $this->assertTrue($subCategorias->getLimit() === 5);
    }
}