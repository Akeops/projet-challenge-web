<?php

require_once './models/directoryManager.php';
require_once './config/database.php';

$directoryManager = new DirectoryManager();
$getUsersByShowInDirectory = $directoryManager->getUsersByShowInDirectory();
var_dump($getUsersByShowInDirectory);
if($getUsersByShowInDirectory){
    $name = $getUsersByShowInDirectory['name'] ?? '';
    $contactInfo = $getUsersByShowInDirectory['contactInfo'] ?? '';
    $description = $getUsersByShowInDirectory['description'] ?? '';
}
    
ob_start();
include './views/pages/directory.php';
$content = ob_get_clean();

include './views/layout.php';