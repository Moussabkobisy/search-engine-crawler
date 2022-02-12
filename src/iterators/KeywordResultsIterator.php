<?php


namespace src\iterators;

class KeywordResultsIterator extends AbstractResultIterator
{
    protected function populate(array $results)
    {
        foreach ($results as $key => $result) {
            $this->results[$key]['url'] = $result->link;
            $this->results[$key]['title'] = $result->title;
            $this->results[$key]['description'] = $result->snippet;
            $this->results[$key]['keyword'] = 'keyword';
            $this->results[$key]['ranking'] = $key+1;
            $this->results[$key]['promoted'] = false; //todo: get promoted and process
        }
    }
}
