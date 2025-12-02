# 🍕 Foodify - Food Ordering Website

A modern, full-featured food ordering website built with PHP, MySQL, HTML, CSS, and JavaScript. Features a stunning UI with smooth animations and complete e-commerce functionality.

## ✨ Features

### User Features
- 🔐 **User Authentication** - Secure login/registration with password hashing
- 🍔 **Browse Menu** - View all available food items with categories
- 🔍 **Search & Filter** - Find food by name or category
- 🛒 **Shopping Cart** - Add/remove items, update quantities
- 💳 **Place Orders** - Complete order process with order confirmation
- 📋 **Order History** - View all past orders and their status
- ❌ **Cancel Orders** - Cancel pending orders
- 📱 **Responsive Design** - Works perfectly on all devices

### Admin Features
- 📊 **Dashboard** - Overview of orders, users, revenue
- ➕ **Add Food Items** - Add new dishes to the menu
- 🗑️ **Delete Food Items** - Remove items from menu
- 📦 **Manage Orders** - View all orders and update status
- 🔄 **Order Status** - Change order status (Pending, Preparing, Delivered, Cancelled)

### Design Features
- 🎨 Modern gradient UI with glassmorphism effects
- ✨ Smooth animations using AOS (Animate On Scroll)
- 🌈 Beautiful color schemes and hover effects
- 📸 Real food images (placeholders - replace with your own)
- 🎯 Clean, intuitive navigation

## 🚀 Installation

### Prerequisites
- XAMPP/WAMP/MAMP or any local server with PHP and MySQL
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Step 1: Clone/Download
```bash
# Clone or download this project to your htdocs folder
# Example: C:/xampp/htdocs/foodify/
```

### Step 2: Database Setup
1. Start Apache and MySQL in XAMPP
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create a new database named `food_ordering_db`
4. Import the SQL file:
   - Go to the database
   - Click "Import" tab
   - Choose `food_ordering_db.sql` file
   - Click "Go"

### Step 3: Configure Database Connection
Edit `includes/db_connect.php` if your database credentials are different:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'food_ordering_db');
```

### Step 4: Add Food Images
Place your food images in the `assets/images/` folder. Default images needed:
- pizza1.jpg, pizza2.jpg, pizza3.jpg
- burger1.jpg, burger2.jpg, burger3.jpg
- dessert1.jpg, dessert2.jpg, dessert3.jpg
- salad1.jpg, salad2.jpg
- pasta1.jpg, pasta2.jpg
- wings.jpg, mozzarella.jpg

**Pro Tip:** Download free food images from:
- Unsplash: https://unsplash.com/s/photos/food
- Pexels: https://www.pexels.com/search/food/

### Step 5: Access the Website
```
User Interface: http://localhost/foodify/
Admin Panel: http://localhost/foodify/admin/dashboard.php
```

## 🔐 Default Credentials

### Admin Login
- **URL:** http://localhost/foodify/admin/dashboard.php
- **Password:** admin123

### Test User Account
Create your own account through the registration page!

## 📁 Folder Structure

```
foodify/
│
├── index.php                 # Home page
├── about.php                 # About us page
├── contact.php               # Contact page
├── menu.php                  # Food menu page
├── cart.php                  # Shopping cart
├── order.php                 # Order history
├── order_confirmation.php    # Order success page
├── login.php                 # User login
├── register.php              # User registration
├── logout.php                # Logout handler
│
├── add_to_cart.php          # Add item to cart (AJAX)
├── update_cart.php          # Update cart quantity (AJAX)
├── remove_from_cart.php     # Remove from cart (AJAX)
├── clear_cart.php           # Clear entire cart (AJAX)
├── place_order.php          # Place order (AJAX)
├── cancel_order.php         # Cancel order (AJAX)
├── get_cart_count.php       # Get cart item count (AJAX)
│
├── /admin
│   ├── dashboard.php        # Admin dashboard
│   ├── add_food.php         # Add/manage food items
│   ├── view_orders.php      # View/manage orders
│   └── admin_logout.php     # Admin logout
│
├── /assets
│   ├── /css
│   │   └── style.css        # Main stylesheet
│   ├── /js
│   │   └── script.js        # JavaScript functionality
│   └── /images
│       └── (food images)    # Food item images
│
└── /includes
    ├── db_connect.php       # Database connection
    ├── header.php           # Header template
    └── footer.php           # Footer template
```

## 🗄️ Database Tables

### users
- id, name, email, password, created_at

### foods
- id, name, category, description, price, image_url, created_at

### cart
- id, user_id, food_id, quantity, added_at

### orders
- id, user_id, total_price, status, created_at

### order_items
- id, order_id, food_id, quantity, price

### contact_messages
- id, name, email, message, created_at

## 🎨 Customization

### Change Colors
Edit `assets/css/style.css` - look for the `:root` section:
```css
:root {
    --primary: #ff6b6b;
    --secondary: #4ecdc4;
    --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Change Website Name
Edit `includes/header.php` and change "Foodify" to your desired name.

### Add Categories
Edit `menu.php` and `admin/add_food.php` to add more food categories.

## 🔧 Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Libraries:**
  - AOS (Animate On Scroll)
  - Font Awesome 6
  - Google Fonts (Poppins)

## 🐛 Troubleshooting

### Cart count not updating
- Make sure JavaScript is enabled
- Check browser console for errors
- Verify AJAX endpoints are accessible

### Images not showing
- Ensure images are in correct folder
- Check file paths in database
- Verify image file names match database entries

### Database connection error
- Verify MySQL is running
- Check database credentials in `db_connect.php`
- Ensure database exists

### Admin panel not accessible
- Clear browser cache and cookies
- Try logging in again with password: admin123

## 📝 Notes

- Change admin password in production!
- Use HTTPS in production environment
- Add proper email functionality for order confirmations
- Implement payment gateway for real transactions
- Add more security measures (CSRF protection, input validation)

## 🚀 Future Enhancements

- Real-time order tracking
- Email notifications
- Payment gateway integration
- Rating and review system
- Loyalty points program
- Multiple delivery addresses
- Coupon/promo code system
- Dark mode toggle

## 📄 License

This project is open source and available for educational purposes.

## 👨‍💻 Developer

Created with ❤️ by @kaifansariw

---

**Enjoy your food ordering website! 🍕🍔🍰**
