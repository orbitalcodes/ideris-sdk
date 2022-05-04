<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Departamentos;
use Ideris\Models\Produto\Departamento;

class DepartamentoTest extends TestCaseApi
{
    public function testCreateRandomDepartamento(): void
    {
        $descricao = $this->faker()->words(2, true);

        $departamentoModel = new Departamento([
            'descricao' => $descricao,
        ]);

        $this->assertInstanceOf(Departamento::class, $departamentoModel);

        $departamentoReturned = $this->getIderisSdk()->departamento()->create($departamentoModel);

        $this->assertInstanceOf(Departamento::class, $departamentoReturned);
        $this->assertEquals($descricao, $departamentoReturned->descricao);

        $departamentoFinded = $this->getIderisSdk()->departamento()->getById($departamentoReturned->id);

        $this->assertInstanceOf(Departamento::class, $departamentoFinded);
        $this->assertEquals($descricao, $departamentoFinded->descricao);
    }

    /**
     * @depends testCreateRandomDepartamento
     */
    public function testGetDepartamentos(): void
    {
        $departamentos = $this->getIderisSdk()->departamento()->get();

        $this->assertInstanceOf(Departamentos::class, $departamentos);
        $this->assertInstanceOf(Collection::class, $departamentos);
        $this->assertInstanceOf(Departamento::class, $departamentos->first());
    }

    /**
     * @depends testCreateRandomDepartamento
     */
    public function testGetDepartamentosPaginate(): void
    {
        $departamentos = $this->getIderisSdk()->departamento()->get();

        $this->assertEquals(0, $departamentos->getOffset());
        $this->assertTrue($departamentos->getCount() <= $departamentos->getLimit());
    }

    /**
     * @depends testCreateRandomDepartamento
     */
    public function testGetDepartamentosOffsetLimit(): void
    {
        $departamentos = $this->getIderisSdk()->departamento()->get(null, 1, 5);

        $this->assertEquals(1, $departamentos->getOffset());
        $this->assertTrue($departamentos->getLimit() === 5);
    }
}