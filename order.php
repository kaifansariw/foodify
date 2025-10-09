<?php
require_once 'includes/db_connect.php';
$pageTitle = 'My Orders - Foodify';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user_id = getUserId();

// Get user orders
$orders_query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
$orders_result = mysqli_query($conn, $orders_query);

include 'includes/header.php';
?>

<div style="padding: 100px 0; min-height: calc(100vh - 400px);">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">My Orders</h1>
        
        <?php if (mysqli_num_rows($orders_result) == 0): ?>
        <div style="text-align: center; padding: 4rem 0;" data-aos="fade-up">
            <i class="fas fa-receipt" style="font-size: 5rem; color: #ddd; margin-bottom: 1rem;"></i>
            <h3>No orders yet</h3>
            <p style="color: #666; margin-bottom: 2rem;">Start ordering delicious food now!</p>
            <a href="menu.php" class="btn btn-primary">Browse Menu</a>
        </div>
        <?php else: ?>
        
        <div style="max-width: 900px; margin: 2rem auto;">
            <?php while ($order = mysqli_fetch_assoc($orders_result)): 
                // Get order items
                $order_id = $order['id'];
                $items_query = "SELECT oi.*, f.name, f.image_url FROM order_items oi 
                               JOIN foods f ON oi.food_id = f.id 
                               WHERE oi.order_id = $order_id";
                $items_result = mysqli_query($conn, $items_query);
                
                $status_colors = [
                    'Pending' => '#ffc107',
                    'Preparing' => '#2196f3',
                    'Delivered' => '#27ae60',
                    'Cancelled' => '#e74c3c'
                ];
                $status_color = $status_colors[$order['status']] ?? '#666';
            ?>
            <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 2rem;" data-aos="fade-up">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h3 style="margin: 0;">Order #<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></h3>
                        <p style="color: #666; margin: 0.3rem 0 0 0;">
                            <?php echo date('M d, Y h:i A', strtotime($order['created_at'])); ?>
                        </p>
                    </div>
                    <div style="text-align: right;">
                        <span style="background: <?php echo $status_color; ?>; color: white; padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 600;">
                            <?php echo $order['status']; ?>
                        </span>
                        <p style="margin: 0.5rem 0 0 0; font-size: 1.3rem; font-weight: 700; color: #ff6b6b;">
                            $<?php echo number_format($order['total_price'], 2); ?>
                        </p>
                    </div>
                </div>
                
                <div style="border-top: 2px solid #f0f0f0; padding-top: 1rem;">
                    <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                    <div style="display: flex; gap: 1rem; padding: 0.8rem 0; align-items: center;">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        <div style="flex: 1;">
                            <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                            <span style="color: #666; font-size: 0.9rem;">Qty: <?php echo $item['quantity']; ?> × $<?php echo number_format($item['price'], 2); ?></span>
                        </div>
                        <strong style="color: #ff6b6b;">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <?php if ($order['status'] == 'Pending'): ?>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #f0f0f0;">
                    <button class="btn btn-danger cancel-order-btn" data-order-id="<?php echo $order['id']; ?>">
                        <i class="fas fa-times-circle"></i> Cancel Order
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        
        <?php endif; ?>
    </div>
</div>

<script>
document.querySelectorAll('.cancel-order-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order-id');
        
        if (confirm('Are you sure you want to cancel this order?')) {
            fetch('cancel_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `order_id=${orderId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Failed to cancel order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred');
            });
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>