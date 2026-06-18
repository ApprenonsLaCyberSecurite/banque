<?php

$dbHost = "localhost";
$dbName = "banque";
$dbUser = "root";
$dbPassword = "";

// Data Source Name
$dsn = "mysql:host=$dbHost;dbname=$dbName";

// PHP Data Object
$pdo = new PDO($dsn, $dbUser, $dbPassword);

?>