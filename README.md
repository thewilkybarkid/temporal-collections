Temporal collections
====================

[![Build Status](https://travis-ci.org/thewilkybarkid/temporal-collections.png?branch=master)](https://travis-ci.org/thewilkybarkid/temporal-collections)

This library provides temporal collection classes, which can be used to easily implement [temporal properties](http://martinfowler.com/eaaDev/TemporalProperty.html).

Installation
------------

Use Composer to add the library to your dependencies:

    $ php composer.phar require thewilkybarkid/temporal-collections:~1.0@dev

Usage
-----

    $collection = new \TheWilkyBarKid\TemporalCollections\OpenEndedTemporalCollection();

    $collection->get('1950-01-01'); // returns null
    $collection->get('1975-01-01'); // returns null
    $collection->get('2000-01-01'); // returns null

    $collection->set('foo', '1975-01-01', '1999-12-31');

    $collection->get('1950-01-01'); // returns null
    $collection->get('1975-01-01'); // returns 'foo'
    $collection->get('2000-01-01'); // returns null

    $collection->set('bar', '1990-01-01', null);

    $collection->get('1950-01-01'); // returns null
    $collection->get('1975-01-01'); // returns 'foo'
    $collection->get('2000-01-01'); // returns 'bar'
