<?php
header("Content-Type: text/html; charset=utf8");

include ("inc/header.php");
require_once ("Cliente.php");

$cliente = new Cliente($_GET['id']);

$cliente->view();

include ("inc/footer.php");
