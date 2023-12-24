<?php

require 'config/routes.php';

function getController($page): string
{
    global $availableRoutes, $defaultRoute;

    if ($page !== null && array_key_exists($page, $availableRoutes)) {
        return $availableRoutes[$page];
    } else {
        return $defaultRoute;
    }
}