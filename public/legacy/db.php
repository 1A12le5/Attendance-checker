<?php
$mysqli = new mysqli("localhost", "root", "123456789", "attendance_ip");
if ($mysqli->connect_errno) {
    http_response_code(500);
    die(json_encode(["error" => "Failed to connect to MySQL: " . $mysqli->connect_error]));
}
$mysqli->set_charset("utf8mb4");
?>