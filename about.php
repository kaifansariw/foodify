<?php
require_once 'includes/db_connect.php';
$pageTitle = 'About Us - Foodify';
include 'includes/header.php';
?>

<div style="padding-top: 80px;">
    <section style="background: linear-gradient(rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200') center/cover; padding: 100px 0; color: white; text-align: center;">
        <div class="container">
            <h1 data-aos="fade-up" style="font-size: 3rem; margin-bottom: 1rem;">About Foodify</h1>
            <p data-aos="fade-up" data-aos-delay="200" style="font-size: 1.3rem; max-width: 700px; margin: 0 auto;">
                Bringing delicious food and happiness to your doorstep since 2020
            </p>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div data-aos="fade-right">
                    <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Our Story</h2>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: #666; margin-bottom: 1rem;">
                        Foodify started with a simple idea: everyone deserves access to delicious, quality food at their convenience. We partner with the best local restaurants and cloud kitchens to bring you an amazing variety of cuisines.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: #666; margin-bottom: 1rem;">
                        Our mission is to make food ordering effortless, enjoyable, and reliable. With thousands of satisfied customers and growing, we're committed to delivering not just food, but smiles.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: #666;">
                        From your favorite pizza to exotic international cuisines, we've got it all covered with quick delivery and excellent service.
                    </p>
                </div>
                <div data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=600" alt="Restaurant" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
                </div>
            </div>
        </div>
    </section>
    
    <section class="section" style="background: white;">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Our Values</h2>
            <div class="food-grid">
                <div class="food-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                        <i class="fas fa-heart" style="font-size: 3.5rem; color: #ff6b6b; margin-bottom: 1rem;"></i>
                        <h3 class="food-name">Quality First</h3>
                        <p class="food-description">We partner only with restaurants that meet our high standards for quality and hygiene.</p>
                    </div>
                </div>
                <div class="food-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                        <i class="fas fa-clock" style="font-size: 3.5rem; color: #4ecdc4; margin-bottom: 1rem;"></i>
                        <h3 class="food-name">Fast Delivery</h3>
                        <p class="food-description">Your time is valuable. We ensure your food reaches you hot and fresh within 30 minutes.</p>
                    </div>
                </div>
                <div class="food-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="food-info" style="text-align: center; padding: 3rem 1.5rem;">
                        <i class="fas fa-users" style="font-size: 3.5rem; color: #667eea; margin-bottom: 1rem;"></i>
                        <h3 class="food-name">Customer Care</h3>
                        <p class="food-description">Our dedicated support team is available 24/7 to assist you with any queries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">By The Numbers</h2>
            <div class="food-grid" style="grid-template-columns: repeat(4, 1fr);">
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="100">
                    <h3 style="font-size: 3rem; color: #667eea; margin-bottom: 0.5rem;">500+</h3>
                    <p style="font-size: 1.2rem; color: #666;">Partner Restaurants</p>
                </div>
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                    <h3 style="font-size: 3rem; color: #667eea; margin-bottom: 0.5rem;">50K+</h3>
                    <p style="font-size: 1.2rem; color: #666;">Happy Customers</p>
                </div>
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
                    <h3 style="font-size: 3rem; color: #667eea; margin-bottom: 0.5rem;">100K+</h3>
                    <p style="font-size: 1.2rem; color: #666;">Orders Delivered</p>
                </div>
                <div style="text-align: center;" data-aos="fade-up" data-aos-delay="400">
                    <h3 style="font-size: 3rem; color: #667eea; margin-bottom: 0.5rem;">4.8/5</h3>
                    <p style="font-size: 1.2rem; color: #666;">Average Rating</p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>