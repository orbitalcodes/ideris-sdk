<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class TestCaseApi extends TestCase
{
    protected $login_token;

    protected function setUp(): void
    {
        $this->login_token = getenv('LOGIN_TOKEN');
    }
}