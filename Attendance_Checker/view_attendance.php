<?php
header('Content-Type: application/json');
require 'db.php';

$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

if ($student_id > 0) {
    $res = $mysqli->query("SELECT a.date, u.name as student, a.status
        FROM attendance a
        JOIN users u ON a.student_id = u.id
        WHERE a.student_id = $student_id
        ORDER BY a.date DESC");
} else {
    $res = $mysqli->query("SELECT a.date, u.name as student, a.status
        FROM attendance a
        JOIN users u ON a.student_id = u.id
        ORDER BY a.date DESC");
}

$records = [];
while ($row = $res->fetch_assoc()) {
    $records[] = $row;
}
echo json_encode($records);
?>