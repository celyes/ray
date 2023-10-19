<?php

namespace Celyes;

use Celyes\Exceptions\NonListArrayException;
use Countable;
use Celyes\Exceptions\UndefinedElementException;
use PHPUnit\Logging\Exception;

class Ray implements Countable
{
    protected function __construct(protected array $input)
    {
    }

    /**
     * Create a ray object from an array
     * @param array $input
     * @return self
     */
    public static function from(array $input): self
    {
        return new self($input);
    }

    /**
     * Get the first element from a ray object as Element
     * @return Element|Ray
     * @throws UndefinedElementException
     */
    public function first(): Element|Ray
    {
        $key = array_key_first($this->input);
        return $this->get($key);
    }

    /**
     * Get an element by key
     * @param $key
     * @return Element|Ray
     * @throws UndefinedElementException
     */
    public function get($key): Element|Ray
    {
        if (isset($this->input[$key])) {
            return Element::from($key, $this->input[$key]);
        }
        throw new UndefinedElementException("Element with this index doesn't exist in the given array");

    }

    /**
     * Get the last element from a ray object as Element
     * @return Element|Ray
     * @throws UndefinedElementException
     */
    public function last(): Element|Ray
    {
        $key = array_key_last($this->input);
        return $this->get($key);
    }

    /**
     *  Get the input array
     * @return array
     */
    public function all(): array
    {
        return $this->input;
    }

    /**
     * Count of the input array elements
     * @return int
     */
    public function count(): int
    {
        return count($this->input);
    }

    /**
     * get the nth element from an array
     * @param $key
     * @return Element|Ray
     * @throws NonListArrayException
     */
    public function nth($key): Element|Ray
    {
        if (array_is_list($this->input)) {
            $index = array_keys($this->input)[$key - 1];
            return Element::from($index, $this->input[$index]);
        }
        throw new NonListArrayException("The provided array is not a list. Use the get() function or make sure the index is correct.");
    }
}