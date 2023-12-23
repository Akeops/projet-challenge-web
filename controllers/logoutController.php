<?php

ob_start();
include './views/pages/logout.php';
$content = ob_get_clean();

include './views/layout.php';