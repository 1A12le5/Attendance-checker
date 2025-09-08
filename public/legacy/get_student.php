<?php
header('Content-Type: application/json');
require 'db.php';

$result = $mysqli->query("SELECT id, name FROM users WHERE role = 'student' ORDER BY name ASC");
$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}
echo json_encode($students);
?>