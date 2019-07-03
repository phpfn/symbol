# Symbol

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

