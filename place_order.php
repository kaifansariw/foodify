<?php
require_once 'includes/db_connect.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = getUserId();
    
    // Get cart items
    $cart_query = "SELECT c.*, f.price FROM cart c JOIN foods f ON c.food_id = f.id WHERE c.user_id = $user_id";
    $cart_result = mysqli_query($conn, $cart_query);
    
    if (mysqli_num_rows($cart_result) == 0) {
        echo json_encode(['success' => false, 'message' => 'Your cart is empty']);
        exit;
    }
    
    // Calculate total
    $subtotal = 0;
    $cart_items = [];
    
    while ($item = mysqli_fetch_assoc($cart_result)) {
        $item_total = $item['price'] * $item['quantity'];
        $subtotal += $item_total;
        $cart_items[] = $item;
    }
    
    $delivery_fee = 2.99;
    $tax = $subtotal * 0.1;
    $total = $subtotal + $delivery_fee + $tax;
    
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        // Create order
        $insert_order = "INSERT INTO orders (user_id, total_price, status) VALUES ($user_id, $total, 'Pending')";
        
        if (!mysqli_query($conn, $insert_order)) {
            throw new Exception('Failed to create order');
        }
        
        $order_id = mysqli_insert_id($conn);
        
        // Add order items
        foreach ($cart_items as $item) {
            $food_id = $item['food_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            
            $insert_item = "INSERT INTO order_items (order_id, food_id, quantity, price) 
                           VALUES ($order_id, $food_id, $quantity, $price)";
            
            if (!mysqli_query($conn, $insert_item)) {
                throw new Exception('Failed to add order items');
            }
        }
        
        // Clear cart
        $clear_cart = "DELETE FROM cart WHERE user_id = $user_id";
        
        if (!mysqli_query($conn, $clear_cart)) {
            throw new Exception('Failed to clear cart');
        }
        
        // Commit transaction
        mysqli_commit($conn);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Order placed successfully',
            'order_id' => $order_id
        ]);
        
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>