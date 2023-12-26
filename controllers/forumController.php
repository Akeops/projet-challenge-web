<?php

require_once './models/usersManager.php';
require_once './config/database.php';
require_once './models/rolesManager.php';

$userManager = new UsersManager();
$userManager = new RolesManager();


// LOGIQUE ICI

ob_start();
include './views/pages/register.php';
$content = ob_get_clean();

include './views/layout.php';