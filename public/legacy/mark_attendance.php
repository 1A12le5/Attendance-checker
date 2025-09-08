<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['date']) || !isset($data['attendance'])) {
    echo json_encode(["success" => false, "error" => "No data provided."]);
    exit;
}

$date = $mysqli->real_escape_string($data['date']);
$attendance = $data['attendance']; // array of {student_id, status}

// Remove existing attendance for that date
$mysqli->query("DELETE FROM attendance WHERE date='$date'");

foreach ($attendance as $rec) {
    $student_id = intval($rec['student_id']);
    $status = $mysqli->real_escape_string($rec['status']);
    $mysqli->query("INSERT INTO attendance (date, student_id, status) VALUES ('$date', $student_id, '$status')");
}

echo json_encode(["success" => true]);
?>