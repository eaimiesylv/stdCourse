<?php

namespace Tests\Unit;
use App\Service\CurrencyService;

use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_convert_usd_to_eur()
    {
        $result =(new CurrencyService())->convert(100,'usd','eur');
        $this->assertEquals(98,$result);
    } 
}
