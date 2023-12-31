# Ray

### :palestinian_territories: Children in Palestine need your help! Donate [here](https://donate.unrwa.org/gaza/~my-donation?_cv=1) :palestinian_territories:

Ray is a simple library that provides a fluent and elegant syntax to access elements on arrays.

Some of the features of Ray include accessing first element, last element, a specific element and it works on nested arrays too.
## Installation
You can install Ray via composer package manager:
```shell
composer require celyes/ray
```

## Usage:

The code below contains a few examples on how to use this simple library.

```php

// create a Ray object from any array...
$array = Ray::from([
    'first' => ['foo' => 'bar'],
    'second' => ['bar' => 'baz'],
    1 => [2, 3]
])

// Access elements however you like

echo $array->first()->last(); // bar.
echo $array->nth(1)->last(); // baz

echo $array->get('first')->get('foo')->key(); // foo
echo $array->get('first')->get('foo')->value(); // bar

// we called value since it's not a string + PHP does not offer a magic method similar to __toString when it comes to numeric values.
echo $array->last->nth(1)->value(); // 3
```

## Iterating through values

You can iterate through the values of a Ray object by using the `each()` method. 
This method accepts a callable to be executed on the every element of the array. Note that this method changes the array in place.

Here's an example:

```php
$array = Ray::from([
    'first' => ['foo' => 'bar'],
    'second' => ['bar' => 'baz'],
    1 => [2, 3]
])

$array->each(function($key, value) {
    // do some stuff with the key and value
})
```
The `each()` method returns the same object, so you can keep chaining methods like `first()`, `last()` and all.

If you don't want to change the array in place, you can use the `all()` method along with the good old foreach statement. 
Here's an example:

```php
$array = Ray::from([
    'first' => ['foo' => 'bar'],
    'second' => ['bar' => 'baz'],
    1 => [2, 3]
])

foreach($array->all() as $key => value) {
    // do some stuff with the key and value
}
```

## accessing keys and values

You can access keys and values of an array using the `keys()` and `values()` methods:

```php
$array = Ray::from([
    'first' => ['foo' => 'bar'],
    'second' => ['bar' => 'baz'],
    1 => [2, 3]
])

$array->first()->keys(); // ['foo'];
$array->nth(2)->values(); // ['baz'];
$array->last()->keys(); // [0, 1];
$array->last()->values(); // [2, 3];
```