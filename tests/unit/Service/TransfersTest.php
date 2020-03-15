<?php

namespace TranferWise\Test;

use TransferWise\Model\Transfer;
use TransferWise\Model\TransferDetails;
use TransferWise\Service\Transfers;

class TransfersTest extends TestCase
{
    /** @var Transfers */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootFixturesDir = __DIR__;
        $this->service         = new Transfers($this->client->reveal());
    }

    public function testList()
    {
        $this->setupMock('GET', '/v1/transfers', null, [], 'get_transfers');
        $transfers = $this->service->list();

        $this->assertIsArray($transfers);
        $this->assertContainsOnlyInstancesOf(Transfer::class, $transfers);
        $this->assertCount(2, $transfers);

        $t = $transfers[0];
        $this->assertEquals(11111111, $t->id);
        $this->assertEquals(294205, $t->user);
        $this->assertEquals(7993919, $t->targetAccount);
        $this->assertEquals(null, $t->sourceAccount);
        $this->assertEquals(113379, $t->quote);
        $this->assertEquals('e0c9368a-b13d-4c76-bfe6-c9a5226efb95', $t->quoteUuid);
        $this->assertEquals('funds_refunded', $t->status);
        $this->assertEquals('good times', $t->reference);
        $this->assertEquals(1.1179, $t->rate);
        $this->assertEquals('2018-12-16 15:25:51', $t->created);
        $this->assertEquals(null, $t->business);
        $this->assertEquals(null, $t->transferRequest);
        $this->assertInstanceOf(TransferDetails::class, $t->details);
        $this->assertEquals('good times', $t->details->reference);
        $this->assertEquals(false, $t->hasActiveIssues);
        $this->assertEquals(1000, $t->sourceValue);
        $this->assertEquals(895.32, $t->targetValue);
        $this->assertEquals('EUR', $t->sourceCurrency);
        $this->assertEquals('GPB', $t->targetCurrency);
        $this->assertEquals('6D9188CF-FA59-44C3-87A2-4506CE9C1EA3', $t->customerTransactionId);
    }

    public function testListWithFilters()
    {
        $params = [
            'sourceCurrency'   => 'USD',
            'targetCurrency'   => 'GBP',
            'status'           => 'funds_refunded',
            'profile'          => 1234,
            'createdDateStart' => '2018-12-26 15:25:51',
            'createdDateEnd'   => '2018-10-12 15:25:51',
            'offset'           => 4,
            'limit'            => 10,
        ];

        // Mocking response
        $this->client
            ->request('GET', '/v1/transfers', ['query' => $params])
            ->shouldBeCalled()
            ->willReturn($response = $this->getFixture('get_transfers'));

        $transfers = $this->service->list($params);
        $this->assertIsArray($transfers);
        $this->assertContainsOnlyInstancesOf(Transfer::class, $transfers);
    }
}
