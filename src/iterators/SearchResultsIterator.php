<?php


namespace src\iterators;

class SearchResultsIterator extends AbstractResultIterator
{
    protected function populate(array $results)
    {
        $this->results = $results;
    }
}
