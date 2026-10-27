-- ============================================
-- Student Accommodation Database Schema
-- ============================================
-- NOTE: This file does NOT create or switch databases.
-- Before importing, create/select your database in phpMyAdmin
-- (e.g. student_accommodation_new), THEN import this file into it.

-- ---------------------------
-- Users table (login/signup)
-- ---------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------
-- Properties table
-- ---------------------------
CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(100) NOT NULL,
    rent DECIMAL(10,2) NOT NULL,
    rating DECIMAL(2,1) DEFAULT 0,
    image VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------
-- Amenities per property
-- ---------------------------
CREATE TABLE IF NOT EXISTS property_amenities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    amenity VARCHAR(50) NOT NULL,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

-- ---------------------------
-- Bookings table
-- ---------------------------
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    property_id INT NOT NULL,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

-- ---------------------------
-- Reviews table
-- ---------------------------
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    reviewer_name VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

-- ---------------------------
-- Contact messages table
-- ---------------------------
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(150),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------
-- Sample data (matches existing frontend cards)
-- ---------------------------
INSERT INTO properties (name, location, rent, rating, image, description) VALUES
('Sunshine PG', 'Delhi', 6500.00, 4.5, 'images/property1.jpg', 'A comfortable and affordable PG located close to major colleges in Delhi.'),
('Green Nest PG', 'Bangalore', 7500.00, 4.7, 'images/property2.jpg', 'A calm, green-surrounded PG with all modern amenities in Bangalore.'),
('Elite Stay PG', 'Mumbai', 8500.00, 4.8, 'images/property3.jpg', 'Premium student accommodation with gym and top-notch facilities in Mumbai.');

INSERT INTO property_amenities (property_id, amenity) VALUES
(1, 'WiFi'), (1, 'Food'), (1, 'Laundry'), (1, 'AC'),
(2, 'WiFi'), (2, 'Food'), (2, 'Laundry'), (2, 'Parking'),
(3, 'WiFi'), (3, 'Gym'), (3, 'Laundry'), (3, 'AC');

INSERT INTO reviews (property_id, reviewer_name, rating, comment) VALUES
(1, 'Rahul Sharma', 5, 'Great PG with clean rooms, excellent WiFi and good food. The staff is supportive and the location is perfect.'),
(1, 'Priya Verma', 4, 'Safe accommodation for girls. Rooms are spacious and housekeeping service is very good.'),
(2, 'Aman Gupta', 5, 'Affordable rent with all necessary facilities. Highly recommended for students.'),
(2, 'Neha Reddy', 4, 'Peaceful and green surroundings, perfect for studying. Food could be a bit more varied.'),
(3, 'Karan Mehta', 5, 'Premium facilities and a great gym. Slightly pricier but worth it for the comfort.'),
(3, 'Sneha Iyer', 5, 'Very well maintained property with quick support whenever needed.');
