<?php

namespace TranferWise\Test;

use TransferWise\Model\Address;
use TransferWise\Model\Token;
use TransferWise\Model\TokenDetails;
use TransferWise\Service\Users as UsersService;

class UsersTest extends TestCase
{
    /** @var UsersService */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootFixturesDir = __DIR__;
        $this->service = new UsersService($this->client->reveal());
    }

    public function test_me()
    {
        $this->setupMock('GET', '/v1/me', [], [], 'get_me');
        $token = $this->service->me();

        // Validate Token object
        $this->assertInstanceOf(Token::class, $token);
        $this->assertEquals(101, $token->id);
        $this->assertEquals('Example Person', $token->name);
        $this->assertEquals('person@example.com', $token->email);
        $this->assertTrue($token->active);

        // Validate TokenDetail object
        $tokenDetails = $token->details;
        $this->assertInstanceOf(TokenDetails::class, $tokenDetails);
        $this->assertEquals('Example', $tokenDetails->firstName);
        $this->assertEquals('Person', $tokenDetails->lastName);
        $this->assertEquals('Magician', $tokenDetails->occupation);
        $this->assertEquals('1977-01-01', $tokenDetails->dateOfBirth);
        $this->assertEquals('https://lh6.googleusercontent.com/photo.jpg', $tokenDetails->avatar);
        $this->assertEquals('111', $tokenDetails->primaryAddress);

        // Validate Address
        $address = $token->details->address;
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Tallinn', $address->city);
        $this->assertEquals('EE', $address->countryCode);
        $this->assertEquals('11111', $address->postCode);
        $this->assertEquals('CA', $address->state);
        $this->assertEquals('Road 123', $address->firstLine);
    }
}