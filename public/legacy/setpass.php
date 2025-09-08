<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$idnumber = $mysqli->real_escape_string($data['idnumber']);
$new_password = $mysqli->real_escape_string($data['new_password']);

if (strlen($new_password) < 4) {
    echo json_encode(["success" => false, "error" => "Password must be at least 4 characters."]);
    exit;
}

$mysqli->query("UPDATE users SET password='$new_password' WHERE idnumber='$idnumber'");
if ($mysqli->affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to set password."]);
}
?>