<?php

require_once './config/routes.php';

// Récupération des clés du tableau associatif de routes
$availableRouteNames = array_keys(AVAILABLE_ROUTES);

// Check si le paramètre GET "page" existe et est bien dans le tableau de route (l'argument "true" vérifie aussi le type du paramètre)
if (isset($_GET['page']) && in_array($_GET['page'], $availableRouteNames, true)) {
	$controller = AVAILABLE_ROUTES[$_GET['page']];
} else {
	$controller = DEFAULT_ROUTE;
}

// Inclusion du contrôleur
require './controllers/' . $controller;