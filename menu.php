<?php
require_once 'includes/db_connect.php';
$pageTitle = 'Menu - Foodify';
include 'includes/header.php';

// Get categories
$category_query = "SELECT DISTINCT category FROM foods ORDER BY category";
$category_result = mysqli_query($conn, $category_query);

// Get all foods or filter by category
$where_clause = "";
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = sanitize($_GET['category']);
    $where_clause = "WHERE category = '$category'";
}

$foods_query = "SELECT * FROM foods $where_clause ORDER BY category, name";
$foods_result = mysqli_query($conn, $foods_query);
?>

<div style="padding-top: 100px; min-height: calc(100vh - 400px);">
    <div class="container">
        <h1 class="section-title" data-aos="fade-up">Our Menu</h1>
        
        <div class="search-filter" data-aos="fade-up">
            <div class="search-box">
                <input type="text" class="form-control" id="searchInput" placeholder="Search for food...">
            </div>
            <div class="filter-buttons">
                <button class="filter-btn <?php echo !isset($_GET['category']) ? 'active' : ''; ?>" onclick="filterCategory('')">All</button>
                <?php while ($cat = mysqli_fetch_assoc($category_result)): ?>
                <button class="filter-btn <?php echo (isset($_GET['category']) && $_GET['category'] == $cat['category']) ? 'active' : ''; ?>" 
                        onclick="filterCategory('<?php echo htmlspecialchars($cat['category']); ?>')">
                    <?php echo htmlspecialchars($cat['category']); ?>
                </button>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="food-grid" id="foodGrid">
            <?php while ($food = mysqli_fetch_assoc($foods_result)): ?>
            <div class="food-card" data-aos="zoom-in" data-name="<?php echo strtolower($food['name']); ?>" data-category="<?php echo strtolower($food['category']); ?>">
                <img src="<?php echo htmlspecialchars($food['image_url']); ?>" alt="<?php echo htmlspecialchars($food['name']); ?>" class="food-image">
                <div class="food-info">
                    <span class="food-category"><?php echo htmlspecialchars($food['category']); ?></span>
                    <h3 class="food-name"><?php echo htmlspecialchars($food['name']); ?></h3>
                    <p class="food-description"><?php echo htmlspecialchars($food['description']); ?></p>
                    <div class="food-footer">
                        <span class="food-price">$<?php echo number_format($food['price'], 2); ?></span>
                        <?php if (isLoggedIn()): ?>
                        <button class="btn btn-primary add-to-cart" data-id="<?php echo $food['id']; ?>" data-name="<?php echo htmlspecialchars($food['name']); ?>" data-price="<?php echo $food['price']; ?>">
                            <i class="fas fa-cart-plus"></i> Add
                        </button>
                        <?php else: ?>
                        <a href="login.php" class="btn btn-primary">Login to Order</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const foodCards = document.querySelectorAll('.food-card');
    
    foodCards.forEach(card => {
        const name = card.getAttribute('data-name');
        const category = card.getAttribute('data-category');
        
        if (name.includes(searchTerm) || category.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

function filterCategory(category) {
    if (category === '') {
        window.location.href = 'menu.php';
    } else {
        window.location.href = 'menu.php?category=' + category;
    }
}
</script>

<?php include 'includes/footer.php'; ?>