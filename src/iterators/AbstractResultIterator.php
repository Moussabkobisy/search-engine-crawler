<?php


namespace src\iterators;
use ArrayIterator;
use Iterator;

abstract class AbstractResultIterator extends ArrayIterator implements Iterator
{
    protected $results = [];
    private $pointer = 0;

    public function __construct(array $results)
    {
        $this->populate($results);
    }
    public function rewind()
    {
        $this->pointer = 0;
    }
    public function valid()
    {
        return isset($this->results[$this->pointer]);
    }
    public function next()
    {
        $this->pointer++;
    }
    public function key()
    {
        return $this->pointer;
    }
    public function current()
    {
        return $this->results[$this->pointer];
    }
    protected function populate(array $results)
    {
    }
}
