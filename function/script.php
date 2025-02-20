<?php
$mysqli = new mysqli("localhost", "admin", "", "airnav" );
if ($mysqli->connect_errno != 0){
    die($mysqli->connect_error);
}

$sql = "SELECT * FROM izinrute";
$res = $mysqli->query($sql);
$data = [];
while($row = $res->fetch_assoc()){
    array_push($data, $row);
}

echo json_encode($data);