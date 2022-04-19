<?php

namespace Tests;

use Ideris\Api\Ideris;
use Ideris\Classes\Collection;
use Ideris\Model\Status;
use Ideris\Model\Statuses;

class StatusTest extends TestCaseApi
{
    public function testGetStatuses(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $statuses = $iderisSdk->status()->get();
        $this->assertInstanceOf(Statuses::class, $statuses);
        $this->assertInstanceOf(Collection::class, $statuses);
        $this->assertInstanceOf(Status::class, $statuses->first());
    }

    public function testGetStatusesPaginate(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $statuses = $iderisSdk->status()->get();

        $this->assertEquals(0, $statuses->getOffset());
        $this->assertTrue($statuses->getCount() <= $statuses->getLimit());
    }

    public function testGetStatusesOffsetLimit(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $statuses = $iderisSdk->status()->get(2, 5);

        $this->assertEquals(2, $statuses->getOffset());
        $this->assertTrue($statuses->getCount() === 5);
        $this->assertTrue($statuses->getTotal() <= 50);
        $this->assertTrue($statuses->getLimit() === 5);
    }
}