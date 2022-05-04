<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Categorias;
use Ideris\Models\Produto\Categoria;

class CategoriaTest extends TestCaseApi
{
    public function testCreateRandomCategoria(): void
    {
        $descricao = $this->faker()->words(2, true);

        $categoriaModel = new Categoria([
            'descricao' => $descricao,
        ]);

        $this->assertInstanceOf(Categoria::class, $categoriaModel);

        $categoriaReturned = $this->getIderisSdk()->categoria()->create($categoriaModel);

        $this->assertInstanceOf(Categoria::class, $categoriaReturned);
        $this->assertEquals($descricao, $categoriaReturned->descricao);

        $categoriaFinded = $this->getIderisSdk()->categoria()->getById($categoriaReturned->id);

        $this->assertInstanceOf(Categoria::class, $categoriaFinded);
        $this->assertEquals($descricao, $categoriaFinded->descricao);
    }

    /**
     * @depends testCreateRandomCategoria
     */
    public function testGetCategorias(): void
    {
        $categorias = $this->getIderisSdk()->categoria()->get();

        $this->assertInstanceOf(Categorias::class, $categorias);
        $this->assertInstanceOf(Collection::class, $categorias);
        $this->assertInstanceOf(Categoria::class, $categorias->first());
    }

    /**
     * @depends testCreateRandomCategoria
     */
    public function testGetCategoriasPaginate(): void
    {
        $categorias = $this->getIderisSdk()->categoria()->get();

        $this->assertEquals(0, $categorias->getOffset());
        $this->assertTrue($categorias->getCount() <= $categorias->getLimit());
    }

    /**
     * @depends testCreateRandomCategoria
     */
    public function testGetCategoriasOffsetLimit(): void
    {
        $categorias = $this->getIderisSdk()->categoria()->get(null, 1, 5);

        $this->assertEquals(1, $categorias->getOffset());
        $this->assertTrue($categorias->getLimit() === 5);
    }
}