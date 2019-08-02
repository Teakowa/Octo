<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

class TencentSearchTest extends TestCase
{
    public function testSearch()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/search.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->search('Octo');

        $this->assertObjectHasAttribute('list', $result->data->song);
    }
}
