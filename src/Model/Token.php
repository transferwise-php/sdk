<?php

namespace TransferWise\Model;

class Token extends BaseModel
{
    /**@var string */
    public $id;

    /**@var string */
    public $name;

    /**@var string */
    public $email;

    /**@var bool */
    public $active;

    /**@var TokenDetails */
    public $details;

    protected $mapping = [
        'details' => TokenDetails::class
    ];
}
