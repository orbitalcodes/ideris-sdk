<?php

namespace Tests;

use Ideris\Client\ApiException;

class ContaTest extends TestCaseApi
{
    public function testGetAccounts(): void
    {
        try {
            $accounts = $this->getIderisSdk()->account()->getByIds(1);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(ApiException::class, $exception);
        }
    }
}