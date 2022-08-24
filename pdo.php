<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=oramex', 'oramexproperty', 'orpr41999');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
error_reporting(E_ALL);
ini_set('display_errors',1);