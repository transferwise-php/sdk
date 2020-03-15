<?php

namespace TransferWise\Model;

class TokenDetails extends BaseModel
{
    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var string */
    public $phoneNumber;

    /** @var string */
    public $occupation;

    /** @var Address */
    public $address;

    /** @var string */
    public $dateOfBirth;

    /** @var string */
    public $avatar;

    /** @var string */
    public $primaryAddress;

    protected $mapping = [
        'address' => Address::class,
    ];
}
