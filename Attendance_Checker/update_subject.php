<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (
    !$data ||
    !isset($data['idnumber']) ||
    !isset($data['subject'])
) {
    echo json_encode(["success" => false, "error" => "No data provided."]);
    exit;
}

$idnumber = $mysqli->real_escape_string($data['idnumber']);
$subject = $mysqli->real_escape_string($data['subject']);

$stmt = $mysqli->prepare("UPDATE users SET subject=? WHERE idnumber=? AND role='teacher'");
$stmt->bind_param("ss", $subject, $idnumber);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to update subject."]);
}
?>