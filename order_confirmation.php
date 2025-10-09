<?php
require_once 'includes/db_connect.php';
$pageTitle = 'Order Confirmation - Foodify';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
$user_id = getUserId();

// Get order details
$order_query = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id";
$order_result = mysqli_query($conn, $order_query);

if (mysqli_num_rows($order_result) == 0) {
    header('Location: menu.php');
    exit;
}

$order = mysqli_fetch_assoc($order_result);

// Get order items
$items_query = "SELECT oi.*, f.name, f.image_url FROM order_items oi 
                JOIN foods f ON oi.food_id = f.id 
                WHERE oi.order_id = $order_id";
$items_result = mysqli_query($conn, $items_query);

include 'includes/header.php';
?>

<div style="padding: 100px 0; min-height: calc(100vh - 400px);">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center;" data-aos="zoom-in">
                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                    <i class="fas fa-check" style="font-size: 3rem; color: white;"></i>
                </div>
                
                <h1 style="color: #27ae60; margin-bottom: 1rem;">Order Placed Successfully!</h1>
                <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">Thank you for your order. We're preparing your delicious meal!</p>
                
                <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; text-align: left;">
                        <div>
                            <strong>Order ID:</strong><br>
                            <span style="color: #667eea; font-size: 1.2rem;">#<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></span>
                        </div>
                        <div>
                            <strong>Order Time:</strong><br>
                            <?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?>
                        </div>
                        <div>
                            <strong>Status:</strong><br>
                            <span style="background: #ffc107; color: white; padding: 0.3rem 1rem; border-radius: 20px; font-size: 0.9rem;">
                                <?php echo $order['status']; ?>
                            </span>
                        </div>
                        <div>
                            <strong>Total Amount:</strong><br>
                            <span style="color: #ff6b6b; font-size: 1.3rem; font-weight: 700;">$<?php echo number_format($order['total_price'], 2); ?></span>
                        </div>
                    </div>
                </div>
                
                <h3 style="margin: 2rem 0 1rem; text-align: left;">Order Items</h3>
                <div style="text-align: left;">
                    <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                    <div style="display: flex; gap: 1rem; padding: 1rem; border-bottom: 1px solid #eee; align-items: center;">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                        <div style="flex: 1;">
                            <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                            <span style="color: #666;">Quantity: <?php echo $item['quantity']; ?> × $<?php echo number_format($item['price'], 2); ?></span>
                        </div>
                        <strong style="color: #ff6b6b;">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <a href="order.php" class="btn btn-primary" style="flex: 1;">View My Orders</a>
                    <a href="menu.php" class="btn btn-secondary" style="flex: 1;">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>