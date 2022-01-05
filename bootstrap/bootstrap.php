<?php

use AliReaza\DependencyInjection\DependencyInjectionContainer as DIC;
use AliReaza\DependencyInjection\DependencyInjectionContainerBuilder as DICBuilder;
use AliReaza\ErrorHandler\ErrorHandler;
use AliReaza\ErrorHandler\Render\JsonResponse as RenderErrorHandler;

return (new class(DICBuilder::getInstance()) {
    private ErrorHandler $error_handler;

    /**
     * @param DIC $container
     */
    public function __construct(private DIC $container)
    {
        $this->container->set(ErrorHandler::class, function (): ErrorHandler {
            $error_handler = new ErrorHandler();
            $error_handler->register(true, false);
            $error_handler->setRender(RenderErrorHandler::class);

            return $error_handler;
        });

        $this->error_handler = $this->container->resolve(ErrorHandler::class);
    }

    /**
     * @return void
     */
    public function __invoke(): void
    {
        $this->error_handler->setDebug(env('APP_DEBUG', false));
        $this->error_handler->addTrace(env('APP_DEBUG_ADD_TRACE', false));
    }
})();