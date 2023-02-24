<?php

namespace Applocker;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LockMiddleware implements MiddlewareInterface
{
    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Get the password from the request
        $password = $request->getQueryParams()['password'] ?? '';

        // If the password is incorrect, return a 403 error response
        if ($password !== $this->password) {
            $response = new \GuzzleHttp\Psr7\Response();
            return $response->withStatus(403);
        }

        // If the password is correct, call the next middleware in the chain
        return $handler->handle($request);
    }
}
