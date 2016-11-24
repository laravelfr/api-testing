# Laravel Api Testing
#### _By the LaravelFr Team_

This package provide you some methods to fully test your Laravel API.

The LaravelFr team is a group of french friends who decide to put in common some useful methods for testing API.
Whoever you are, feel free to contribute to this package or join the organisation to add yours !


[![Travis Build](https://img.shields.io/travis/laravelfr/api-testing/master.svg)](https://travis-ci.org/laravelfr/api-testing?branch=master) 
[![StyleCI](https://styleci.io/repos/74501976/shield?branch=master)](https://styleci.io/repos/74501976) 
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravelfr/api-testing.svg)](https://scrutinizer-ci.com/g/laravelfr/api-testing/?branch=master) 
[![Code Quality](https://img.shields.io/scrutinizer/g/laravelfr/api-testing.svg)](https://scrutinizer-ci.com/g/laravelfr/api-testing/?branch=master) 

## Installation 

```sh
composer require laravelfr/api-testing
```

## Usage

Once Laravel API Testing is installed, you can extend or implement the classes and traits in this package. There are no service providers to register.

Example : 
```php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as LaravelTestCase;
use LaravelFr\ApiTesting\AssertArrays;

class TestCase extends LaravelTestCase
{
    use AssertArrays;
    
    ...
```
