-- Explicitly create and use the correct database
CREATE DATABASE IF NOT EXISTS pinewood_autoshop;
USE pinewood_autoshop;

-- Set SQL mode to be more permissive temporarily
SET SQL_MODE = '';

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    vehicle_info VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
) ENGINE=InnoDB;

-- Auth sessions table
CREATE TABLE IF NOT EXISTS auth_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Service history table
CREATE TABLE IF NOT EXISTS service_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_type VARCHAR(100) NOT NULL,
    service_date DATE NOT NULL,
    mileage INT,
    comments TEXT,
    cost DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Create sample user with simple password (for development only)
-- Password is 'password' hashed with bcrypt
INSERT IGNORE INTO users (name, email, password) VALUES 
('Admin User', 'admin@pinewood.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample service history
INSERT IGNORE INTO service_history (user_id, service_type, service_date, mileage, comments, cost) VALUES
(1, 'Oil Change', DATE_SUB(CURDATE(), INTERVAL 1 MONTH), 45000, 'Synthetic oil change with filter replacement', 89.99),
(1, 'Tire Rotation', DATE_SUB(CURDATE(), INTERVAL 3 MONTH), 42000, 'Standard tire rotation and balance', 39.99),
(1, 'Brake Inspection', DATE_SUB(CURDATE(), INTERVAL 6 MONTH), 38000, 'Full brake system inspection', 29.99);

-- Restore default SQL mode
SET SQL_MODE = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';