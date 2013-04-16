php-graphico-api
================

Client library for [Graphico](https://github.com/yuya-takeyama/graphico) API

Usage
-----

### Basic Usage

```php
<?php
require_once '/path/to/Graphico/Api/Autoloader.php';

Graphico_Api_Autoloader::register('/path/to/Graphico');

$client = new Graphico_Api_Client(
    new Graphico_Api_HttpClient_PearClient,
    'http://graphicohost/api/v0'
);

$client->call('PUT', '/awesome_service/wonderful_content/unique_users/daily/2013-01-01', array(
    'type'  => 'countable',
    'count' => 1000,
));
```

### Short Alias Methods

`Graphico_Api_Client->call()` has its short alias methods.

```php
<?php
// GET request
$client->get('/path', $params);

// POST request
$client->post('/path', $params);

// PUT request
$client->put('/path', $params);

// DELETE request
$client->delete('/path', $params);
```

### Error Handling

`Graphico_Api_Client->call()` and its short alias methods may return `Graphico_Api_ResponseInterface` object. And it knows whether the requeset is finished successfully or not.

```php
$res = $client->put('/path', $params);

if ($res->isSuccess()) {
    // Success
} else if ($res->isClientError()) {
    // Some client error like 404 Not Found
    // $res['message'] may have error message.
} else if ($res->isServerError()) {
    // Some server error like 500 Internal Server Error
}
```

Author
------

Yuya Takeyam
