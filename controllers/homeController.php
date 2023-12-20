<?php

ob_start();
include './views/pages/home.php';
$content = ob_get_clean();

include './views/layout.php';
