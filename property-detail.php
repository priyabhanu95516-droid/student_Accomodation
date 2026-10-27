<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>

    <link rel="stylesheet" href="css/property-detail.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <!--================ Breadcrumb ================-->

    <section class="breadcrumb">

        <a href="index.php">Home</a>

        <span>></span>

        <a href="properties.php">Properties</a>

        <span>></span>

        <p id="breadcrumbName">Loading...</p>

    </section>

    <!--================ Property Banner ================-->

    <section class="property-banner">

        <img id="propertyImage" src="images/property1.jpg" alt="Property">

    </section>

    <!--================ Property Summary ================-->

    <section class="property-summary">

        <div class="summary-left">

            <div class="rating">

                ⭐⭐⭐⭐☆

                <span id="propertyRating">Loading rating...</span>

            </div>

            <h1 id="propertyName">Loading...</h1>

            <p class="address" id="propertyLocation">

                📍 Loading...

            </p>

            <div class="gender">

                <span>Boys & Girls</span>

            </div>

        </div>

        <div class="summary-right">

            <h2 id="propertyRent">₹-- / Month</h2>

            <p>Security Deposit : ₹5,000</p>

            <p id="bookMessage" style="display:none;"></p>

            <button class="book-btn" id="bookBtn">

                Book Now

            </button>

        </div>

    </section>
        <!--================ About Property ================-->

    <section class="about-property">

        <h2>About the Property</h2>

        <p id="propertyDescription">

            Loading description...

        </p>

    </section>

    <!--================ Amenities ================-->

    <section class="property-amenities">

        <h2>Amenities</h2>

        <div class="amenities-grid" id="amenitiesGrid">

            <p>Loading amenities...</p>

        </div>

    </section>
        <!--================ Property Rating ================-->

    <section class="property-rating">

        <h2>Property Rating</h2>

        <div class="rating-container">

            <div class="overall-rating">

                <h1 id="overallRatingNum">--</h1>

                <p id="overallRatingStars">☆☆☆☆☆</p>

                <span id="overallRatingCount">Loading...</span>

            </div>

            <div class="rating-details" id="ratingDetails">

                <div class="rating-row">
                    <span>Cleanliness</span>
                    <progress id="ratingCleanliness" value="0" max="100"></progress>
                </div>

                <div class="rating-row">
                    <span>Food Quality</span>
                    <progress id="ratingFood" value="0" max="100"></progress>
                </div>

                <div class="rating-row">
                    <span>Security</span>
                    <progress id="ratingSecurity" value="0" max="100"></progress>
                </div>

                <div class="rating-row">
                    <span>Location</span>
                    <progress id="ratingLocation" value="0" max="100"></progress>
                </div>

                <div class="rating-row">
                    <span>Value for Money</span>
                    <progress id="ratingValue" value="0" max="100"></progress>
                </div>

            </div>

        </div>

    </section>

    <!--================ Student Reviews ================-->

    <section class="student-reviews">

        <h2>Student Reviews</h2>

        <div class="review-grid" id="reviewGrid">

            <p>Loading reviews...</p>

        </div>

    </section>

    <!--================ Similar Properties ================-->

    <section class="similar-properties">

        <h2>Similar Properties</h2>

        <div class="similar-grid" id="similarGrid">

            <p>Loading...</p>

        </div>

    </section>
        <!--================ Footer ================-->

    <footer class="footer">

        <div class="footer-container">

            <div class="footer-about">

                <h2>Student Accommodation</h2>

                <p>

                    Find safe, comfortable and affordable student accommodations
                    across India. We help students choose the best PG according
                    to their budget and preferred location.

                </p>

            </div>

            <div class="footer-links">

                <h3>Quick Links</h3>

                <ul>

                    <li><a href="index.php">Home</a></li>

                    <li><a href="properties.php">Properties</a></li>

                    <li><a href="about-us.php">About Us</a></li>

                    <li><a href="contact-us.html">Contact Us</a></li>

                    <li><a href="login.html">Login</a></li>

                    <li><a href="signup.html">Signup</a></li>

                </ul>

            </div>

            <div class="footer-contact">

                <h3>Contact</h3>

                <p>📍 Ambala, Haryana</p>

                <p>📞 +91 9876543210</p>

                <p>✉️ support@studentaccommodation.com</p>

            </div>

        </div>

        <hr>

        <p class="copyright">

            © 2026 Student Accommodation. All Rights Reserved.

        </p>

    </footer>

    <script src="js/config.js"></script>
    <script src="js/property-detail.js"></script>
</body>

</html>