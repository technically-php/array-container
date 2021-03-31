![Tests Status][badge]

# Technically Array Container

`Technically\ArrayContainer` is a plain-simple [PSR-11][1] container implementation 
powered by a simple associative array under the hood.

## Features

- PSR-11
- PHP 7.1+
- PHP 8.0
- Semver
- Tests

## Installation

Use [Composer][2] package manager to add *ArrayContainer* to your project:

```
composer require technically/array-container
```

## Example

```php
<?php

use Technically\ArrayContainer\ArrayContainer;

// ... instantiate your services: $logger, $cache, $config

// Instantiate with predefined entries
$container = new ArrayContainer([
    'logger' => $logger,
    'cache'  => $cache,
]);

// Add more entries later
$container->set('config', $config);

// Get entries from it later in your code
$logger = $container->get('logger');
```

## Changelog

All notable changes to this project will be documented in the [CHANGELOG][./CHANGELOG.md] file.


## Credits

- Implemented by [Ivan Voskoboinyk][3]


[1]: https://www.php-fig.org/psr/psr-11/
[2]: https://getcomposer.org/
[3]: https://github.com/e1himself?utm_source=web&utm_medium=github&utm_campaign=technically/array-container
[badge]: https://github.com/technically-php/array-container/actions/workflows/test.yml/badge.svg
