<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = (int)$_POST['cart_id'];
    $action = sanitize($_POST['action']);
    $user_id = getUserId();
    
    // Verify cart item belongs to user
    $verify_query = "SELECT quantity FROM cart WHERE id = $cart_id AND user_id = $user_id";
    $verify_result = mysqli_query($conn, $verify_query);
    
    if (mysqli_num_rows($verify_result) == 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid cart item']);
        exit;
    }
    
    $cart_item = mysqli_fetch_assoc($verify_result);
    $current_quantity = $cart_item['quantity'];
    
    if ($action == 'increase') {
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE id = $cart_id";
    } elseif ($action == 'decrease') {
        if ($current_quantity <= 1) {
            // Remove item if quantity becomes 0
            $query = "DELETE FROM cart WHERE id = $cart_id";
        } else {
            $query = "UPDATE cart SET quantity = quantity - 1 WHERE id = $cart_id";
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
    }
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Cart updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>