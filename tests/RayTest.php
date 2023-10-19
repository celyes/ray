<?php

use Celyes\Element;
use Celyes\Exceptions\NonListArrayException;
use Celyes\Exceptions\UndefinedElementException;
use Celyes\Ray;

it('should get first element of a normal array', function () {
    $array = Ray::from([1, 2, 3]);
    $first = $array->first();
    expect($first)
        ->toBeInstanceOf(Element::class)
        ->and(intval((string)$first))
        ->toBe(1);
});

it('should get first of a associative array', function () {
    $array = Ray::from(['foo' => 'bar', 'bar' => 'baz']);
    $last = $array->first();
    expect($last)->toBeInstanceOf(Element::class)
        ->and((string)$last)
        ->toBe('bar')
        ->and($last->key())
        ->toBe('foo');
});

it('should get last element of a normal array', function () {
    $array = Ray::from([1, 2, 3]);
    $last = $array->last();
    expect($last)->toBeInstanceOf(Element::class)
        ->and(intval((string)$last))
        ->toBe(3)
        ->and($last->key())
        ->toBe(2);;
});

it('should get last element of an associative array', function () {
    $array = Ray::from(['foo' => 'bar', 'bar' => 'baz']);
    $last = $array->last();
    expect($last)->toBeInstanceOf(Element::class)
        ->and((string)$last)
        ->toBe('baz')
        ->and($last->key())
        ->toBe('bar');
});

it('should get a specific element of the array', function () {
    $array = Ray::from([
        [1, 2, 3, 4],
        [5, 6, 7, 8],
        [9, 10, 11, 12]
    ]);
    expect(intval((string)$array->get(1)->first()))->toBe(5)
        ->and(intval((string)$array->last()->get(3)))->toBe(12)
        ->and(intval((string)$array->first()->last()))->toBe(4);
});

it('should get all elements of array', function () {
    expect(Ray::from([1, 2, 3])->all())->toBeArray();
});

it('should get the first element of the first element in a nested array', function () {
    $array = Ray::from([
        'one' => [
            'foo' => 'bar'
        ]
    ]);
    $nested_first = $array->first()->first();
    expect((string)$nested_first)->toBe('bar')
        ->and($nested_first->key())->toBe('foo');
});

it('should get the nth element with key and value', function () {
    $array = Ray::from([
        [1, 2, 3, 4],
        [5, 6, 7, 8],
        [9, 10, 11, 12]
    ]);
    expect(intval((string)$array->nth(1)->first()))
        ->toBe(1)
        ->and(intval((string)$array->get(1)->nth(3)))
        ->toBe(7)
        ->and(intval((string)$array->last()->nth(3)))
        ->toBe(11);
});

it('should throw a UndefinedElementException when index is not found', function () {
    Ray::from([
        'one' => [
            'foo' => 'bar',
            'bar' => 'baz',
            'baz' => 'foo'
        ]
    ])->first()->get(1);
})->throws(
    UndefinedElementException::class,
    'Element with this index doesn\'t exist in the given array'
);

it('should throw a NonListArrayException when using nth on non associative arrays', function () {
    Ray::from([
        'one' => [
            'foo' => 'bar',
            'bar' => 'baz',
            'baz' => 'foo'
        ]
    ])->nth(1)->first();
})->throws(
    NonListArrayException::class,
    'The provided array is not a list. Use the get() function or make sure the index is correct.'
);