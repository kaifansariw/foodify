<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = (int)$_POST['order_id'];
    $user_id = getUserId();
    
    // Verify order belongs to user and is pending
    $verify_query = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id AND status = 'Pending'";
    $verify_result = mysqli_query($conn, $verify_query);
    
    if (mysqli_num_rows($verify_result) == 0) {
        echo json_encode(['success' => false, 'message' => 'Order cannot be cancelled']);
        exit;
    }
    
    // Update order status
    $update_query = "UPDATE orders SET status = 'Cancelled' WHERE id = $order_id";
    
    if (mysqli_query($conn, $update_query)) {
        echo json_encode(['success' => true, 'message' => 'Order cancelled successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to cancel order']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>