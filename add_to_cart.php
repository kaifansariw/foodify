<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food_id = (int)$_POST['food_id'];
    $user_id = getUserId();
    
    if ($food_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid food item']);
        exit;
    }
    
    // Check if item already in cart
    $check_query = "SELECT * FROM cart WHERE user_id = $user_id AND food_id = $food_id";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Update quantity
        $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND food_id = $food_id";
        
        if (mysqli_query($conn, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Cart updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }
    } else {
        // Add new item
        $insert_query = "INSERT INTO cart (user_id, food_id, quantity) VALUES ($user_id, $food_id, 1)";
        
        if (mysqli_query($conn, $insert_query)) {
            echo json_encode(['success' => true, 'message' => 'Added to cart']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add to cart']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>