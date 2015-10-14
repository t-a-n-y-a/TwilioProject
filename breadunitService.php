<?php
header('Content-Type: application/xml');

require('/home/dwsa/sahin/mysqlCredentials.php');
$dbname = "sahin_pace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = strtolower($_GET["Body"]);

$sql = "SELECT breadUnit, itemName FROM BreadUnits WHERE itemName LIKE '%$message%'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  $responseMessage = 'Item not found';
} else {
  $row = $result->fetch_assoc();
  $responseMessage = $row['itemName'] . ' has ' . $row['breadUnit'] . ' BU';
}

print ('<?xml version="1.0" encoding="UTF-8" ?> <Response> <Message>' . $responseMessage . '</Message> </Response>');

?>
