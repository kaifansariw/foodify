<?php
require_once 'includes/db_connect.php';
$pageTitle = 'Contact Us - Foodify';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $message = sanitize($_POST['message']);
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all fields';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        
        if (mysqli_query($conn, $query)) {
            $success = 'Thank you for contacting us! We will get back to you soon.';
        } else {
            $error = 'Failed to send message. Please try again.';
        }
    }
}

include 'includes/header.php';
?>

<div style="padding-top: 80px;">
    <section style="background: linear-gradient(rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)), url('https://images.unsplash.com/photo-1551135049-8a33b5883817?w=1200') center/cover; padding: 100px 0; color: white; text-align: center;">
        <div class="container">
            <h1 data-aos="fade-up" style="font-size: 3rem; margin-bottom: 1rem;">Get In Touch</h1>
            <p data-aos="fade-up" data-aos-delay="200" style="font-size: 1.3rem;">
                We'd love to hear from you. Send us a message!
            </p>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;">
                <div data-aos="fade-right">
                    <h2 style="font-size: 2rem; margin-bottom: 2rem;">Contact Information</h2>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: start;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.5rem;">Address</h4>
                            <p style="color: #666;">123 Food Street, Culinary District<br>New York, NY 10001</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: start;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-phone" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.5rem;">Phone</h4>
                            <p style="color: #666;">+1 (555) 123-4567<br>+1 (555) 987-6543</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: start;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-envelope" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.5rem;">Email</h4>
                            <p style="color: #666;">info@foodify.com<br>support@foodify.com</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: start;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-clock" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.5rem;">Working Hours</h4>
                            <p style="color: #666;">Monday - Sunday<br>24/7 Service</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 3rem;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s" 
                                width="100%" 
                                height="300" 
                                style="border:0; border-radius: 15px;" 
                                allowfullscreen="" 
                                loading="lazy">
                        </iframe>
                    </div>
                </div>
                
                <div data-aos="fade-left">
                    <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <h2 style="font-size: 2rem; margin-bottom: 2rem;">Send Us A Message</h2>
                        
                        <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>