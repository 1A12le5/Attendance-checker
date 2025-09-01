<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (
    !$data ||
    !isset($data['idnumber']) ||
    !isset($data['name']) ||
    !isset($data['password'])
) {
    echo json_encode(["success" => false, "error" => "No data provided."]);
    exit;
}

$idnumber = $mysqli->real_escape_string($data['idnumber']);
$name = $mysqli->real_escape_string($data['name']);
$password = $data['password'];

if (strlen($password) < 4) {
    echo json_encode(["success" => false, "error" => "Password must be at least 4 characters."]);
    exit;
}

// Check if student already exists
$res = $mysqli->query("SELECT * FROM users WHERE idnumber='$idnumber' LIMIT 1");
if ($res->num_rows > 0) {
    echo json_encode(["success" => false, "error" => "A user with this ID number already exists."]);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO users (idnumber, name, password, role) VALUES (?, ?, ?, 'student')");
$stmt->bind_param("sss", $idnumber, $name, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to add student."]);
}
?>