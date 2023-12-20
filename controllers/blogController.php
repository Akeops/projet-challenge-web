<?php

$template = './views/pages/showBlog.php';

require_once './models/blogManager.php';

$monBlog = new Blog();

$id = $_GET["id"];
$blog = $monBlog->getBlogByID($id);