<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (
    !$data ||
    !isset($data['idnumber']) ||
    !isset($data['password']) ||
    !isset($data['role'])
) {
    echo json_encode(["success" => false, "error" => "No data provided."]);
    exit;
}

$idnumber = $mysqli->real_escape_string($data['idnumber']);
$password = $data['password'];
$role = ($data['role'] === 'teacher') ? 'teacher' : 'student';

// Check if user exists
$res = $mysqli->query("SELECT * FROM users WHERE idnumber='$idnumber' LIMIT 1");

if ($res->num_rows == 0) {
    // Only allow teacher self-registration
    if ($role === 'teacher') {
        $name = ucfirst($role) . " $idnumber";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (idnumber, name, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $idnumber, $name, $hashed_password, $role);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $user = [
                "id" => $user_id,
                "idnumber" => $idnumber,
                "name" => $name,
                "role" => $role,
                "subject" => null
            ];
            echo json_encode(["success" => true, "user" => $user, "registered" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Registration failed."]);
        }
    } else {
        // Student not found, do not register
        echo json_encode(["success" => false, "error" => "Student not found. Please contact your teacher."]);
    }
    exit;
}

$user = $res->fetch_assoc();

if (password_verify($password, $user['password'])) {
    unset($user['password']);
    echo json_encode(["success" => true, "user" => [
        "id" => $user['id'],
        "idnumber" => $user['idnumber'],
        "name" => $user['name'],
        "role" => $user['role'],
        "subject" => $user['subject']
    ], "registered" => false]);
} else {
    echo json_encode(["success" => false, "error" => "Invalid password."]);
}
?>