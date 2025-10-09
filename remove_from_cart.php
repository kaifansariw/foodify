<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = (int)$_POST['cart_id'];
    $user_id = getUserId();
    
    $query = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>