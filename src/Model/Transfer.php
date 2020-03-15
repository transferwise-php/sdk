<?php

namespace TransferWise\Model;

class Transfer extends BaseModel
{
    /** @var float */
    public $id;

    /** @var float */
    public $user;

    /** @var int */
    public $targetAccount;

    /** @var int */
    public $sourceAccount;

    /** @var float */
    public $quote;

    /** @var string */
    public $status;

    /** @var string */
    public $reference;

    /** @var float */
    public $rate;

    /** @var string */
    public $created;

    /** @var string */
    public $business;

    /** @var string */
    public $transferRequest;

    /** @var TransferDetails */
    public $details;

    /** @var bool */
    public $hasActiveIssues;

    /** @var float */
    public $sourceValue;

    /** @var string */
    public $sourceCurrency;

    /** @var float */
    public $targetValue;

    /** @var string */
    public $targetCurrency;

    /** @var string */
    public $customerTransactionId;


    protected $mapping = [
        'details' => TransferDetails::class,
    ];
}