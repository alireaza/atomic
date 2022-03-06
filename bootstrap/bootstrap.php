<?php

use AliReaza\Atomic\Containers\DotEnvContainer;
use AliReaza\Atomic\Containers\ErrorHandlerContainer;
use AliReaza\DependencyInjection\DependencyInjectionContainer as DIC;
use AliReaza\DependencyInjection\DependencyInjectionContainerBuilder as DICBuilder;
use AliReaza\DotEnv\DotEnv;
use AliReaza\ErrorHandler\ErrorHandler;

return (new class(DICBuilder::getInstance()) {
    private ErrorHandler $error_handler;

    public function __construct(private DIC $container)
    {
        $this->container->set(ErrorHandler::class, (new ErrorHandlerContainer())());
        $this->error_handler = $this->container->resolve(ErrorHandler::class);

        $this->container->set(DotEnv::class, (new DotEnvContainer())());
    }

    public function __invoke(): void
    {
        $this->error_handler->setDebug(env('APP_DEBUG', false));
        $this->error_handler->addTrace(env('APP_DEBUG_ADD_TRACE', false));
    }
})();
