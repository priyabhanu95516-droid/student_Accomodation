    <!-- Header -->
    <header class="header">

        <div class="logo">Student Accommodation</div>

        <nav class="navbar">
           <a href="index.php">Home</a>
           <a href="properties.php">Properties</a>
           <a href="about-us.php">About Us</a>
           <a href="contact-us.html">Contact Us</a>
           <?php if (!empty($_SESSION['user_name'])): ?>
               <span style="margin-left:35px; font-size:16px; font-weight:600; color:#444;">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
               <a href="logout.php">Logout</a>
           <?php else: ?>
               <a href="login.html">Login</a>
               <a href="signup.html">Signup</a>
           <?php endif; ?>
        </nav>

    </header>
