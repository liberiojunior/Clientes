<?php
header("Content-Type: text/html; charset=utf8");

include ("inc/header.php");
require_once ("Cliente.php");

$cliente = new Cliente();

$cliente->insert();

include ("inc/footer.php");
