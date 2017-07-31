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

It works both with old testing way (Laravel <5.4 and >5.4 with BrowserKit) and with new testing way (with response object).
- Old way: Just use  `\LaravelFr\ApiTesting\AssertArrays` and `\LaravelFr\ApiTesting\AssertJsonResponse` traits, and use directly the methods from traits.
- New way: for `AssertJsonResponse`, you can add the trait, and directly use the methods on response object.

See Tests for some examples.

## Available methods: 

On this response example : 
```
{
   "foo": 134,
   "foobar": {
       "foobar_foo": "foo",
       "foobar_bar": 212
   },
   "bars": [
       {
           "bar": true,
           "foo": 134.212
       },
       {
           "bar": false,
           "foo": 134.212
       },
       {
           "bar": false,
           "foo": 134.212
       }
   ],
   "baz": [
       {
           "foo": "Laravel",
           "bar": {
               "foo": true,
               "bar": 134
           }
       },
       {
           "foo": "France",
           "bar": {
               "foo": false,
               "bar": 212
           }
       }
   ]
}
```
 - `assertJsonStructureEquals`: check if it respects the **exact** structure pattern.
 ```php
 $response->assertJsonStructureEquals([
     'foo',
     'baz' => ['*' => ['bar' => ['*'], 'foo']],
     'bars' => ['*' => ['bar', 'foo']],
     'foobar' => ['foobar_foo', 'foobar_bar'],
 ]);
 ```
 
 - `seeJsonTypedStructure`: check if it respects a typed pattern.
 ```php
 $response->seeJsonTypedStructure([
     'foo' => 'integer',
     'baz' => ['*' => ['bar' => 'array', 'foo' => 'string']],
     'bars' => ['*' => ['bar' => 'boolean', 'foo' => 'float']],
     'foobar' => ['foobar_foo' => 'string', 'foobar_bar' => 'int'],
 ]);
 ```
 - `seeJsonTypedStructure`: retrieve a part of response in array format.
 ```php
 $response->jsonResponse('foobar.foobar_bar')); // 212
 ```
 ## Credits
 - Maintenance: Mathieu TUDISCO <dev@mathieutu.ovh>,
 - Methods: 
    - [@mathieutu](https://github.com/mathieutu)
    - [@welcoMattic](https://github.com/welcomattic)
    
 Please feel free to make PRs and add yours!


