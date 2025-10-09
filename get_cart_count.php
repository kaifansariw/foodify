<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['count' => 0]);
    exit;
}

$user_id = getUserId();
$query = "SELECT SUM(quantity) as total FROM cart WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode(['count' => $row['total'] ?? 0]);
?>