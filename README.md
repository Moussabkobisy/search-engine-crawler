# PHP search engine crawler

## Installation

You can install the package via composer:

``` bash
composer require mossab/search-engine-crawler
```
or you can add the package to your composer.json then `composer install`
```php
    //...
  "require": {
        "mossab/search-engine-crawler": "dev-main"
    }
```
## Usage
first of all you need to add your `API key` and `CX` to your `.env` file
```php
<?php
require __DIR__.'/vendor/autoload.php';
(new \src\configs\Config(__DIR__.'/.env'))->load(); // set your .env path

$myGenerator = new src\SearchEngine();
$myGenerator->setEngine('google.com');
$results =  $myGenerator->search(['flower','horizon']);
```
you will get an `ArrayIterator` instance contains these parameters : 
```
- keyword being searched
- ranking (where the result was found on the search engine, the topmost result would be 0 and the last would be 50 (results per page x 5)
- url of the page (as it appears in google search)
- title of the page (as it appears in google search)
- description (as it appears in google search)
- promoted This is a boolean value indicating whether the result is an ad or organic result
```
you can loop results
```php
foreach ($results as $result){
    echo "title is : ".$result['title']."<br>".
        "ranking is = ".$result['ranking']."<br>".
        "url is : ".$result['url']."<br>".
        "description is :".$result['description']."<br>".
        "keyword is :".$result['keyword']."<br>";
}

```
## search Engines
supported search engine is `google.com` or `google.ae`
