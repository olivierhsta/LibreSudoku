<?php

namespace App\Domain\Command;

use BadMethodCallException;
use function is_callable;
use ReflectionClass;
use ReflectionMethod;

abstract class Command
{
    public function __call($name, $arguments)
    {
        $class = new ReflectionClass(static::class);

        $privateMethods = array_map(function ($reflectionMethod) {
            return $reflectionMethod->name;
        }, $class->getMethods(ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PRIVATE));

        if (in_array($name, $privateMethods)) {
            return $class->getMethod($name)->invoke($arguments); // returns an error if the asked method is private of protected
        }

        if (!in_array($name, array_keys(get_object_vars($this)))) {
            $message = "No property '$name' in class " . static::class;
            throw new BadMethodCallException($message);
        }
        return get_object_vars(clone $this)[$name];
    }
}
