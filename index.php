<?php
require_once 'includes/db_connect.php';
$pageTitle = 'Foodify - Order Delicious Food Online';
include 'includes/header.php';

// Fetch popular foods
$popular_query = "SELECT * FROM foods ORDER BY RAND() LIMIT 6";
$popular_result = mysqli_query($conn, $popular_query);
?>

<section class="hero">
    <div class="container">
        <h1 data-aos="fade-up">Welcome to Foodify</h1>
        <p data-aos="fade-up" data-aos-delay="200">Delicious food delivered to your doorstep in minutes</p>
        <a href="menu.php" class="btn btn-primary" data-aos="fade-up" data-aos-delay="400">Browse Menu</a>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Popular Dishes</h2>
        <div class="food-grid">
            <?php while ($food = mysqli_fetch_assoc($popular_result)): ?>
            <div class="food-card" data-aos="zoom-in">
                <img src="<?php echo htmlspecialchars($food['image_url']); ?>" alt="<?php echo htmlspecialchars($food['name']); ?>" class="food-image">
                <div class="food-info">
                    <span class="food-category"><?php echo htmlspecialchars($food['category']); ?></span>
                    <h3 class="food-name"><?php echo htmlspecialchars($food['name']); ?></h3>
                    <p class="food-description"><?php echo htmlspecialchars($food['description']); ?></p>
                    <div class="food-footer">
                        <span class="food-price">$<?php echo number_format($food['price'], 2); ?></span>
                        <button class="btn btn-primary add-to-cart" data-id="<?php echo $food['id']; ?>">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="menu.php" class="btn btn-secondary">View Full Menu</a>
        </div>
    </div>
</section>

<section class="section" style="background: white;">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Why Choose Foodify?</h2>
        <div class="food-grid">
            <div class="food-card" data-aos="fade-right">
                <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                    <i class="fas fa-shipping-fast" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                    <h3 class="food-name">Fast Delivery</h3>
                    <p class="food-description">Get your food delivered hot and fresh within 30 minutes</p>
                </div>
            </div>
            <div class="food-card" data-aos="fade-up">
                <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                    <i class="fas fa-star" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                    <h3 class="food-name">Quality Food</h3>
                    <p class="food-description">Fresh ingredients and chef-prepared meals every time</p>
                </div>
            </div>
            <div class="food-card" data-aos="fade-left">
                <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                    <i class="fas fa-headset" style="font-size: 3rem; color: #667eea; margin-bottom: 1rem;"></i>
                    <h3 class="food-name">24/7 Support</h3>
                    <p class="food-description">Our customer service team is always ready to help</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>