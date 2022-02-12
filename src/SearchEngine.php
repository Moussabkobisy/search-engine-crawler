<?php

namespace src;
use ArrayIterator;
use Exception;
use src\clients\RestClient;
use src\iterators\KeywordResultsIterator;
use src\iterators\SearchResultsIterator;

class SearchEngine
{
    private $engine = "";
    private $result = [];


    /**
     * @param array $keywords
     * @return ArrayIterator
     * @throws Exception
     */
    public function search(array $keywords): ArrayIterator
    {
        try {
            foreach ($keywords as $keyword) {
                array_push($this->result, ...$this->searchKeyword($keyword));
            }
            return new SearchResultsIterator($this->result);

        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param string $keyword
     * @return ArrayIterator
     */
    private function searchKeyword(string $keyword):ArrayIterator
    {
        $keywordArray = [];
        for ($i=0; $i < 5; $i++){

            $restClient = new RestClient();
            $result = $restClient->buildUriAndCall($keyword,$this->engine,$i*10+1);

           if(isset($result->items)) // check if there is a result for this call
               array_push($keywordArray,...$result->items);

           if (!isset($result->queries->nextPage)) // if there is no next page then stop calling server
               break;
        }
        return new KeywordResultsIterator($keywordArray,$keyword);
    }

    /**
     * @param string $engine
     * @throws Exception
     */
    public function setEngine(string $engine)
    {
        switch ($engine){
            case "google.ae": $this->engine = "&g1=ae";break;
            case "google.com": $this->engine = "";break;
            default : throw new Exception('unknown search engine');
        }
    }
}
