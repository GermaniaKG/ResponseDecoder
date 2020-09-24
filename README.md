

<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------




# Germania KG · ResponseDecoder



## Installation

```bash
$ composer require germania-kg/response-decoder
```



## Usage

The **JsonApiResponseDecoder** aims at responses adhering to the [JSON:API](https://jsonapi.org/) standard. It implements the `Psr\Http\Message\ResponseInterface` and provides two public public methods:

- `getResource( ResponseInterface $response) : array`
- `getResourceCollection( ResponseInterface $response) : array`



```php
<?php
use Germania\ResponseDecoder\ResponseDecoderInterface;
use Germania\ResponseDecoder\JsonApiResponseDecoder;

$response = ...
  
$decoder = new JsonApiResponseDecoder;

// Both are arrays
$resourceCollection = $decoder->getResourceCollection($response);
$singleResource = $decoder->getResource($response);
```



## Example

### Collections of items

Given this collection of items, each of which is an object within the `data` element.

```json
HTTP/1.1 200 OK
Content-Type: application/vnd.api+json

{
  "links": {
    "self": "http://example.com/articles"
  },
  "data": [{
    "type": "articles",
    "id": "1",
    "attributes": {
      "title": "JSON:API paints my bikeshed!"
    }
  }, {
    "type": "articles",
    "id": "2",
    "attributes": {
      "title": "Rails is Omakase"
    }
  }]
}
```

The **JsonApiResponseDecoder** will now collect each object from the `data` element and extract the `attributes`:

```php
<?php
use Germania\ResponseDecoder\JsonApiResponseDecoder;
  
$response = ...
$items = (new JsonApiResponseDecoder)->getResourceCollection($response);

print_r($items);
// Array {
//   Array {
//     "title" => "JSON:API paints my bikeshed!"
//   },
//   Array {
//     "title" => "Rails is Omakase"
//   }
// }
```



### Single items

```json
HTTP/1.1 200 OK
Content-Type: application/vnd.api+json

{
  "links": {
    "self": "http://example.com/articles/1"
  },
  "data": {
    "type": "articles",
    "id": "1",
    "attributes": {
      "title": "JSON:API paints my bikeshed!"
    },
    "relationships": {
      "author": {
        "links": {
          "related": "http://example.com/articles/1/author"
        }
      }
    }
  }
}
```
The **JsonApiResponseDecoder** will now extract the `attributes` from the `data` element:
```php
<?php
use Germania\ResponseDecoder\JsonApiResponseDecoder;
  
$response = ...

$item = (new JsonApiResponseDecoder)->getResource($response);

print_r($item);
// Array {
//   "title" => "JSON:API paints my bikeshed!"
// }
```





## Development

```bash
$ git clone git@github.com:GermaniaKG/ResponseDecoder.git
$ cd ResponseDecoder
$ composer install
```



## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

