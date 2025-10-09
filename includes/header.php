<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Foodify - Order Delicious Food Online'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <i class="fas fa-utensils"></i>
                    <span>Foodify</span>
                </div>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="menu.php" class="nav-link">Menu</a></li>
                    <li><a href="about.php" class="nav-link">About</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="cart.php" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">0</span>
                    </a>
                    <?php if (isLoggedIn()): ?>
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <i class="fas fa-user"></i>
                                <span><?php echo getUserName(); ?></span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="order.php">My Orders</a>
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary">Login</a>
                    <?php endif; ?>
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>