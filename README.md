# Plates Extension for using Slim CSRF

An extension for plates to use the csrf function from the slim framework

## Install

Use composer to install the script:

```composer require basteyy/plates-slim-csrf```

## Usage

```php
<?php

// Add Csrf to your app according to the documentation here: https://github.com/slimphp/Slim-Csrf
$container->set('csrf', function () use ($responseFactory) {
    return new \Slim\Csrf\Guard($responseFactory);
});

// Add the plates like the documentation here: https://platesphp.com/engine/extensions/
$templates = new League\Plates\Engine('/path/to/templates');

// Add the extension to plates and forwad the csrf GuardClass:
$templates->loadExtension(new \basteyy\PlatesSlimCsrf\PlatesSlimCsrf($container->get('csrf')));

// Inside your form use echo the following:
echo $this->getCsrf(); 
 ```

## License

The MIT License (MIT). Please see [License File](https://github.com/basteyy/plates-slim-csrf/blob/master/LICENSE) for more information.
