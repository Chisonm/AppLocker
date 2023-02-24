<?php

namespace Applocker;

use Psr\Container\ContainerInterface;

class LockMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Get the password from the package configuration
        $password = $container->get('config')['password'] ?? '';

        // Create a new instance of the middleware class
        return new LockMiddleware($password);
    }
}
