<?php

$servername = "lrgs.ftsm.ukm.my";
$username = "a187291";
$password = "littleredfox";
$dbname = "a187291";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

?>
