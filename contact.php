<!-- contact.php -->
<?php include("header.php"); ?>
<link rel="stylesheet" href="style.css">

<div class="contact-container">
    <h1>Contact Us</h1>

    <div class="contact-wrapper">
        <div class="contact-form">
            <form action="contact_submit.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Get in Touch</h3>
            <p><strong>Phone:</strong> +91-1234567890</p>
            <p><strong>Email:</strong> admin@onlinevoting.com</p>
            <p><strong>Address:</strong> SLBS Degree College, Gonda, India</p>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
