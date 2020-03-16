# TransferWise SDK (v1 API Binding for PHP 7)

[![Build Status](https://travis-ci.org/transferwise-php/sdk.svg?branch=master)](https://travis-ci.org/transferwise-php/sdk) ![PHP from Travis config](https://img.shields.io/travis/php-v/transferwise-php/sdk/master)

> **Note**: This library is under active development as we expand it to cover
> our (expanding!) API. Consider the public API of this package a little
> unstable as we work towards a v1.0.

## Installation

The recommended way to install this package is via the Packagist Dependency Manager ([transferwise-php/sdk](https://packagist.org/packages/transferwise-php/sdk)). 

## TransferWise API version 1

The TransferWise API can be found [here](https://api-docs.transferwise.com/).


- [ ] Addresses
- [ ] Borderless Accounts
- [ ] Get Account Balance
- [ ] Get Account Statement
- [ ] Convert Currencies
- [ ] Get Available Currencies
- [ ] Get Currency Pairs
- [ ] Comparison
- [ ] Exchange Rates
- [x] Quotes (Works in progress)
- [ ] Recipient Accounts
- [ ] Simulation
- [ ] Terms and Conditions
- [ ] Transfers
- [x] Users (Works in progress)
- [ ] User Profiles


Note that this repository is currently under development, additional classes and endpoints being actively added.

## Getting Started

```php
<?php 
require 'vendor/autoload.php';

use TransferWise\SDK;

$apiKey = 'your-api-key-here';
$client = SDK::createClient($apiKey, SDK::API_MODE_SANDBOX);
$sdk = new SDK($client);

// Show current authenticated user
/** @var \TransferWise\Model\Token $whoami */
$whoami = $sdk->users()->me();

// List transfers
$transfers = $sdk->transfers()->list(['status' => 'funds_refunded']);
```

## Contributions

We welcome community contribution to this repository. [CONTRIBUTING.md](CONTRIBUTING.md) will help you start contributing.

## Licensing 

Licensed under the 3-clause BSD license. See the [LICENSE](LICENSE) file for details.