<?php
require __DIR__.'/vendor/autoload.php';
(new \src\Config\Config(__DIR__.'/.env'))->load(); // set your .env path

$myGenerator = new src\SearchEngine();
$myGenerator->setEngine('google.com');
$results =  $myGenerator->search(['keyword1','keyword2']);


foreach ($results as $result){
    echo "title is : ".$result['title']."<br>".
        "ranking is = ".$result['ranking']."<br>".
        "url is : ".$result['url'];
}
