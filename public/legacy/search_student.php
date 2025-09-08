<?php
header('Content-Type: application/json');
require 'db.php';

$q = isset($_GET['q']) ? $mysqli->real_escape_string($_GET['q']) : '';
if (!$q) {
    echo json_encode([]);
    exit;
}

$res = $mysqli->query("SELECT idnumber, name FROM users WHERE role='student' AND (idnumber LIKE '%$q%' OR name LIKE '%$q%') ORDER BY name ASC");
$students = [];
while ($row = $res->fetch_assoc()) {
    $students[] = $row;
}
echo json_encode($students);
?>