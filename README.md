<p align="center">
    <h1>Symbol</h1>
</p>
<p align="center">
    <a href="https://travis-ci.org/SerafimArts/Symbol"><img src="https://travis-ci.org/SerafimArts/Symbol.svg" alt="Travis CI" /></a>
    <a href="https://codeclimate.com/github/SerafimArts/Symbol/test_coverage"><img src="https://api.codeclimate.com/v1/badges/43f91ec27407081b8d51/test_coverage" /></a>
    <a href="https://codeclimate.com/github/SerafimArts/Symbol/maintainability"><img src="https://api.codeclimate.com/v1/badges/43f91ec27407081b8d51/maintainability" /></a>
</p>
<p align="center">
    <a href="https://packagist.org/packages/SerafimArts/Symbol"><img src="https://img.shields.io/badge/PHP-7.1+-6f4ca5.svg" alt="PHP 7.1+"></a>
    <a href="https://packagist.org/packages/SerafimArts/Symbol"><img src="https://poser.pugx.org/SerafimArts/Symbol/version" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/SerafimArts/Symbol"><img src="https://poser.pugx.org/SerafimArts/Symbol/downloads" alt="Total Downloads"></a>
    <a href="https://raw.githubusercontent.com/SerafimArts/Symbol/1.4.x/LICENSE.md"><img src="https://poser.pugx.org/SerafimArts/Symbol/license" alt="License MIT"></a>
</p>

The `symbol()` function returns a value of type symbol, has static 
properties that expose several members of built-in objects, 
has static methods that expose the global symbol registry, and 
resembles a built-in object class but is incomplete as a constructor 
because it does not support the syntax "new Symbol()".  

Every symbol value returned from `symbol()` is unique. 
A symbol value may be used as an identifier.

The data type symbol is a primitive data type.

```php
<?php
$symbol = Symbol::create('42');
// same with "symbol('42')" function invocation

echo Symbol::key($symbol);
// expected output: "42"

var_dump(Symbol::create('42') === Symbol::create('42'));
// expected output: "false"
```

## Constants

Usage in defines

```php
<?php

define('PLACEHOLDER', Symbol::create('a'));
```

Usage in classes

```php
class Example
{
    public const EXAMPLE_CONST = PLACEHOLDER; // Awesome magic %)
}
```

## Reflection

```php
<?php

$reflection = Symbol::getReflection(Example::EXAMPLE_CONST);

echo $reflection; 
// expected output: "Symbol(a)"

echo $reflection->getName();
// expected output: "a"

echo $reflection->getFileName();
// expected output: path/to/file.php (with Symbol::create expression definition).
```

