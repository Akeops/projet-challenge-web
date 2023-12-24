<?php
session_start();
require 'config/router.php';

$page = $_GET['page'] ?? null;

$controller = getController($page);

require 'controllers/' . $controller;
