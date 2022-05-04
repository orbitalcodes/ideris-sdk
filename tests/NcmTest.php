<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Ncms;
use Ideris\Models\Produto\Ncm;

class NcmTest extends TestCaseApi
{
    public static $ncmCodigoStatic = '123.456.789';

    public function testCreateStaticNcm(): Ncm
    {
        $ncmModel = new Ncm([
            'codigo'    => self::$ncmCodigoStatic,
            'descricao' => 'Teste de NCM',
        ]);

        $this->assertInstanceOf(Ncm::class, $ncmModel);

        $ncmReturned = $this->getIderisSdk()->ncm()->create($ncmModel);

        $this->assertInstanceOf(Ncm::class, $ncmReturned);

        return $ncmReturned;
    }

    /**
     * @depends testCreateStaticNcm
     */
    public function testGetNcmByCode(Ncm $ncm): Ncm
    {
        $ncmReturned = $this->getIderisSdk()->ncm()->getByCode($ncm->codigo);

        $this->assertInstanceOf(Ncm::class, $ncmReturned);

        return $ncmReturned;
    }

    public function testCreateRandomNcm(): Ncm
    {
        $ncmModel = new Ncm([
            'codigo'    => $this->faker()->randomNumber(5, true),
            'descricao' => $this->faker()->text(30),
        ]);

        $this->assertInstanceOf(Ncm::class, $ncmModel);

        $this->getIderisSdk()->ncm()->create($ncmModel);

        $ncmReturned = $this->getIderisSdk()->ncm()->getByCode($ncmModel->codigo);

        $this->assertInstanceOf(Ncm::class, $ncmReturned);

        return $ncmReturned;
    }

    /**
     * @depends testCreateRandomNcm
     */
    public function testGetNcms(): void
    {
        $ncms = $this->getIderisSdk()->ncm()->get();

        $this->assertInstanceOf(Ncms::class, $ncms);
        $this->assertInstanceOf(Collection::class, $ncms);
        $this->assertInstanceOf(Ncm::class, $ncms->first());
    }

    /**
     * @depends testCreateRandomNcm
     */
    public function testGetNcmsPaginate(): void
    {
        $ncms = $this->getIderisSdk()->ncm()->get();

        $this->assertEquals(0, $ncms->getOffset());
        $this->assertTrue($ncms->getCount() <= $ncms->getLimit());
    }

    /**
     * @depends testCreateRandomNcm
     */
    public function testGetNcmsOffsetLimit(): void
    {
        $ncms = $this->getIderisSdk()->ncm()->get(1, 5);

        $this->assertEquals(1, $ncms->getOffset());
        $this->assertTrue($ncms->getLimit() === 5);
    }
}