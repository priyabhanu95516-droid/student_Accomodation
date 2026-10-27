<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/properties.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

    <?php include 'navbar.php'; ?>

    <!-- Heading -->

    <section class="properties-page">

        <h1>Available Student Accommodations</h1>

        <p>Choose the best PG according to your budget and location.</p>

    </section>

    <!-- Property Cards (loaded dynamically from backend) -->

    <section class="property-list" id="propertyList">
        <p>Loading properties...</p>
    </section>

    <script src="js/config.js"></script>
    <script src="js/properties.js"></script>
</body>

</html>