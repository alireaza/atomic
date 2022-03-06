<?php

use AliReaza\DependencyInjection\DependencyInjectionContainerBuilder as DICBuilder;

if (!function_exists('path')) {
    function path(?string $path = null): string
    {
        $container = DICBuilder::getInstance();

        if (!$container->has('app.path')) {
            $container->set('app.path', realpath(dirname(__FILE__)));
        }

        $app_path = $container->resolve('app.path');

        return $app_path . array_reduce(explode(DIRECTORY_SEPARATOR, ($path ? DIRECTORY_SEPARATOR . $path : '')), function ($carry, $item) {
                if ($item === '' || $item === '.') {
                    return $carry;
                }

                if ($item === '..') {
                    return dirname($carry);
                }

                return $carry . DIRECTORY_SEPARATOR . $item;
            }, DIRECTORY_SEPARATOR);
    }
}
