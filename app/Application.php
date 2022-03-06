<?php

namespace AliReaza\Atomic;

use AliReaza\DependencyInjection\DependencyInjectionContainer as DIC;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application implements HttpKernelInterface
{
    private Response $response;

    public function __construct(private DIC $container)
    {
        $this->response = $this->container->resolve(JsonResponse::class);
    }

    public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): JsonResponse
    {
        return $this->response->send();
    }
}
