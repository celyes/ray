<?php

namespace Celyes;

use Stringable;

class Element implements Stringable
{
    protected function __construct(
        protected mixed $index,
        protected mixed $value
    )
    {}

    /**
     * Create a new Element or Array of Elements from a value
     *
     * @param mixed $key
     * @param mixed $value
     * @return Ray|self
     */
    public static function from(mixed $key, mixed $value): Ray|self
    {
        if (is_scalar($value)) {
            return new self($key, $value);
        }
        return Ray::from($value);
    }

    /**
     * return the current element's key
     *
     * @return string|int|null
     */
    public function key(): string|int|null
    {
        return $this->index;
    }

    public function value(): mixed
    {
        return $this->value;
    }

    /**
     * get the suitable string when treated as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

}