<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou;

class KugouSearchTest extends TestCase
{
    public function testSearch()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/search.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $kugou  = new Kugou($mock);
        $result = $kugou->search('Octo');

        $this->assertObjectHasAttribute('lists', $result->data);
    }
}