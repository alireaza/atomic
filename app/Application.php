<?php

namespace AliReaza\Atomic;

use AliReaza\DependencyInjection\DependencyInjectionContainer as DIC;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Throwable;

/**
 * Class Application
 *
 * @package AliReaza\Atomic
 */
class Application implements HttpKernelInterface
{
    private Response $response;

    /**
     * Application constructor.
     *
     * @param DIC $container
     *
     * @throws Throwable
     */
    public function __construct(private DIC $container)
    {
        $this->response = $this->container->resolve(JsonResponse::class);
    }

    /**
     * @param Request $request
     * @param int $type
     * @param bool $catch
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function handle(Request $request, int $type = self::MAIN_REQUEST, bool $catch = true): JsonResponse
    {
        return $this->response->send();
    }
}