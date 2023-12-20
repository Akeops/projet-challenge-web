<?php

$template = './views/pages/home.php';

require_once './models/blogManager.php';

$monBlog = new Blog();

$blogs = $monBlog->getBlogs();

require_once $template;
