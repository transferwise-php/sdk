<?php

namespace TransferWise\Model;

class Address extends BaseModel
{
    /**@var string */
    public $city;

    /**@var string */
    public $countryCode;

    /**@var string */
    public $postCode;

    /**@var string */
    public $state;

    /**@var string */
    public $firstLine;
}
