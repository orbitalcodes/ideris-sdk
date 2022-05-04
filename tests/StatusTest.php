<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Status;
use Ideris\Models\Status as StatusModel;

class StatusTest extends TestCaseApi
{
    public function testGetStatuses(): void
    {
        $status = $this->getIderisSdk()->status()->get();
        $this->assertInstanceOf(Status::class, $status);
        $this->assertInstanceOf(Collection::class, $status);
        $this->assertInstanceOf(StatusModel::class, $status->first());
    }

    public function testGetStatusesPaginate(): void
    {
        $status = $this->getIderisSdk()->status()->get();

        $this->assertEquals(0, $status->getOffset());
        $this->assertTrue($status->getCount() <= $status->getLimit());
    }

    public function testGetStatusesOffsetLimit(): void
    {
        $status = $this->getIderisSdk()->status()->get(2, 5);

        $this->assertEquals(2, $status->getOffset());
        $this->assertTrue($status->getCount() === 5);
        $this->assertTrue($status->getTotal() <= 50);
        $this->assertTrue($status->getLimit() === 5);
    }
}