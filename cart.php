<?php
require_once 'includes/db_connect.php';
$pageTitle = 'Shopping Cart - Foodify';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user_id = getUserId();

// Get cart items
$cart_query = "SELECT c.*, f.name, f.price, f.image_url, f.category 
               FROM cart c 
               JOIN foods f ON c.food_id = f.id 
               WHERE c.user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

$total = 0;

include 'includes/header.php';
?>

<div style="padding: 100px 0; min-height: calc(100vh - 400px);">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">Shopping Cart</h1>
        
        <?php if (mysqli_num_rows($cart_result) == 0): ?>
        <div style="text-align: center; padding: 4rem 0;" data-aos="fade-up">
            <i class="fas fa-shopping-cart" style="font-size: 5rem; color: #ddd; margin-bottom: 1rem;"></i>
            <h3>Your cart is empty</h3>
            <p style="color: #666; margin-bottom: 2rem;">Add some delicious items to get started!</p>
            <a href="menu.php" class="btn btn-primary">Browse Menu</a>
        </div>
        <?php else: ?>
        
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem; margin-top: 2rem;">
            <div class="cart-items" data-aos="fade-right">
                <?php while ($item = mysqli_fetch_assoc($cart_result)): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                <div class="cart-item" data-id="<?php echo $item['id']; ?>">
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="cart-item-image">
                    <div class="cart-item-info">
                        <h3 class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="cart-item-price">$<?php echo number_format($item['price'], 2); ?> each</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="qty-btn qty-decrease" data-id="<?php echo $item['id']; ?>">-</button>
                        <span class="quantity"><?php echo $item['quantity']; ?></span>
                        <button class="qty-btn qty-increase" data-id="<?php echo $item['id']; ?>">+</button>
                    </div>
                    <div style="text-align: right;">
                        <p class="cart-item-price">$<?php echo number_format($item_total, 2); ?></p>
                        <button class="btn btn-danger btn-sm remove-item" data-id="<?php echo $item['id']; ?>" style="padding: 0.4rem 1rem; font-size: 0.9rem; margin-top: 0.5rem;">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <div data-aos="fade-left">
                <div class="cart-summary">
                    <h3 style="margin-bottom: 1.5rem;">Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotal">$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Delivery Fee:</span>
                        <span>$2.99</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (10%):</span>
                        <span id="tax">$<?php echo number_format($total * 0.1, 2); ?></span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span id="total">$<?php echo number_format($total + 2.99 + ($total * 0.1), 2); ?></span>
                    </div>
                    <button class="btn btn-success" id="placeOrderBtn" style="width: 100%; margin-top: 1.5rem;">
                        <i class="fas fa-check-circle"></i> Place Order
                    </button>
                    <button class="btn btn-danger" id="cancelOrderBtn" style="width: 100%; margin-top: 0.5rem;">
                        <i class="fas fa-times-circle"></i> Clear Cart
                    </button>
                </div>
            </div>
        </div>
        
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>