<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Accommodation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

    <?php include 'navbar.php'; ?>
    <section class="hero">

        <div class="hero-content">

            <h1>Find Your Perfect Student Accommodation</h1>

            <p>
                Discover affordable, safe and comfortable PGs
                near your college.
            </p>

            <div class="search-box">

                <input type="text" id="citySearchInput" placeholder="Enter City">

                <button type="button" id="citySearchBtn">Search</button>

            </div>

        </div>

    </section>
    <section class="cities">

        <h2>Popular Cities</h2>

        <div class="city-container">

            <div class="city-card" data-city="Delhi">

                <img src="images/delhi.png" alt="Delhi">

                <h3>Delhi</h3>

            </div>

            <div class="city-card" data-city="Chennai">

                <img src="images/chennai.png" alt="Chennai">

                <h3>Chennai</h3>

            </div>

            <div class="city-card" data-city="Mumbai">

                <img src="images/mumbai.png" alt="Mumbai">

                <h3>Mumbai</h3>

            </div>

            <div class="city-card" data-city="Bangalore">

                <img src="images/bangalore.png" alt="Bangalore">

                <h3>Bangalore</h3>

            </div>

        </div>

    </section>
    <!-- Featured Properties -->

    <section class="properties">

        <h2>Featured Properties</h2>

        <div class="property-container" id="featuredProperties">

            <p>Loading properties...</p>

        </div>

    </section>

    <!-- Why Choose Us -->

    <section class="why-us">

        <h2>Why Choose Us?</h2>

        <div class="why-container">

            <div class="why-card">
                <h3>✔ Verified Properties</h3>
                <p>All listed PGs are verified for safety and quality.</p>
            </div>

            <div class="why-card">
                <h3>✔ Affordable Rent</h3>
                <p>Find budget-friendly accommodation for students.</p>
            </div>

            <div class="why-card">
                <h3>✔ Safe Environment</h3>
                <p>Comfortable and secure places to stay.</p>
            </div>

            <div class="why-card">
                <h3>✔ 24×7 Support</h3>
                <p>Our support team is always available to help you.</p>
            </div>

        </div>

    </section>
     <!-- Student Reviews -->

    <section class="reviews">

        <h2>What Our Students Say?</h2>

        <div class="review-container">

            <div class="review-card">

                <p>
                    "I found a great PG near my college.
                    The rent is affordable and the
                    environment is perfect for study."
                </p>

                <h4>⭐⭐⭐⭐⭐</h4>

                <h3>Priya Sharma</h3>

            </div>

            <div class="review-card">

                <p>
                    "Very easy to search and book PG.
                    Highly recommended for students
                    looking for accommodation."
                </p>

                <h4>⭐⭐⭐⭐⭐</h4>

                <h3>Aman Verma</h3>

            </div>

            <div class="review-card">

                <p>
                    "The PG I booked is exactly
                    as shown in the pictures.
                    Great service!"
                </p>

                <h4>⭐⭐⭐⭐⭐</h4>

                <h3>Neha Reddy</h3>

            </div>

        </div>

    </section>

    <!-- Footer -->

    <footer class="footer">

        <div class="footer-content">

            <div class="footer-about">

                <h2>Student Accommodation</h2>

                <p>
                    Helping students find safe,
                    affordable and comfortable
                    accommodation near their colleges.
                </p>

            </div>

            <div class="footer-links">

                <h3>Quick Links</h3>

                <p>Home</p>
                <p>Properties</p>
                <p>About Us</p>
                <p>Contact Us</p>

            </div>

            <div class="footer-contact">

                <h3>Contact</h3>

                <p>Email: support@studentaccommodation.com</p>

                <p>Phone: +91 9876543210</p>

            </div>

        </div>

        <hr>

        <p class="copyright">
            © 2026 Student Accommodation. All Rights Reserved.
        </p>

    </footer>

    <script src="js/config.js"></script>
    <script src="js/home.js"></script>
</body>
</html>