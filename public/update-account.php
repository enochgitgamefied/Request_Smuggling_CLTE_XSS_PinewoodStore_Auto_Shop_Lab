<?php
// Start session with settings for XSS demo
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => false,
    'samesite' => 'Lax'
]);
session_start();

// Check authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

// Database configuration
$dbHost = 'mysql';
$dbName = 'pinewood_autoshop';
$dbUser = 'root';
$dbPass = 'secret';

$error = '';
$success = '';
$user = null;

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get current user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        header("Location: /logout.php");
        exit;
    }

    // Parse existing vehicle info (format: "Year Make Model - License")
    $vehicle_info = $user['vehicle_info'] ?? '';
    $vehicle_parts = explode(' ', $vehicle_info);
    $current_vehicle = [
        'year' => $vehicle_parts[0] ?? '',
        'make' => $vehicle_parts[1] ?? '',
        'model' => $vehicle_parts[2] ?? '',
        'license' => isset($vehicle_parts[4]) ? implode(' ', array_slice($vehicle_parts, 4)) : ''
    ];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $make = filter_input(INPUT_POST, 'vehicle_make', FILTER_SANITIZE_STRING);
        $model = filter_input(INPUT_POST, 'vehicle_model', FILTER_SANITIZE_STRING);
        $year = filter_input(INPUT_POST, 'vehicle_year', FILTER_SANITIZE_STRING);
        $license = filter_input(INPUT_POST, 'license_plate', FILTER_SANITIZE_STRING);

        // Validate inputs
        if (empty($name) || empty($make) || empty($model) || empty($year) || empty($license)) {
            $error = "All fields are required";
        } else {
            // Format vehicle info
            $vehicle_info = "$year $make $model - $license";
            
            // Update user in database
            $stmt = $pdo->prepare("UPDATE users SET name = ?, vehicle_info = ? WHERE id = ?");
            $stmt->execute([$name, $vehicle_info, $_SESSION['user_id']]);
            
            $success = "Account updated successfully!";
            
            // Refresh user data
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
        }
    }

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $error = "A database error occurred";
}

$title = "Update Account | PinewoodStore Auto Shop";
include_once("_header.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/css/register.css"> <!-- Reusing your registration styles -->
    <style>
        .update-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 20px;
        }
        
        .update-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 1rem;
        }
        
        .update-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .update-header img {
            height: 80px;
            margin-bottom: 1rem;
        }
        
        .update-header h2 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .update-header p {
            color: #7f8c8d;
        }
        
        .form-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .form-section h3 {
            color: #036DA7;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .vehicle-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .vehicle-select:focus {
            border-color: #036DA7;
            outline: none;
            box-shadow: 0 0 0 2px rgba(3, 109, 167, 0.2);
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }
        
        .cta-button {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .cta-button:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .cancel-button {
            background: #bdc3c7;
            color: #2c3e50;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .cancel-button:hover {
            background: #95a5a6;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 16px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        @media (max-width: 768px) {
            .update-container {
                padding: 0 15px;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .cta-button, .cancel-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="update-container">
        <div class="update-card">
            <div class="update-header">
                <img src="/images/autoshop.png" alt="PinewoodStore Auto Shop">
                <h2>Update Your Account</h2>
                <p>Keep your information up to date</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-section">
                    <h3>Personal Information</h3>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required
                               value="<?= htmlspecialchars($user['name'] ?? '') ?>"
                               class="vehicle-select">
                    </div>
                </div>
                
                <div class="form-section">
                    <h3>Vehicle Information</h3>
                    <div class="form-group">
                        <label for="vehicle_make">Vehicle Make</label>
                        <select id="vehicle_make" name="vehicle_make" required class="vehicle-select">
                            <option value="">Select Make</option>
                            <option value="Toyota" <?= ($current_vehicle['make'] ?? '') === 'Toyota' ? 'selected' : '' ?>>Toyota</option>
                            <option value="Honda" <?= ($current_vehicle['make'] ?? '') === 'Honda' ? 'selected' : '' ?>>Honda</option>
                            <option value="Ford" <?= ($current_vehicle['make'] ?? '') === 'Ford' ? 'selected' : '' ?>>Ford</option>
                            <option value="Chevrolet" <?= ($current_vehicle['make'] ?? '') === 'Chevrolet' ? 'selected' : '' ?>>Chevrolet</option>
                            <option value="Nissan" <?= ($current_vehicle['make'] ?? '') === 'Nissan' ? 'selected' : '' ?>>Nissan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_model">Vehicle Model</label>
                        <select id="vehicle_model" name="vehicle_model" required class="vehicle-select" 
                                <?= empty($current_vehicle['make']) ? 'disabled' : '' ?>>
                            <option value="">Select Model</option>
                            <?php if (!empty($current_vehicle['make'])): ?>
                                <!-- Models will be populated via JavaScript -->
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_year">Year</label>
                        <select id="vehicle_year" name="vehicle_year" required class="vehicle-select">
                            <option value="">Select Year</option>
                            <?php 
                            $current_year = date('Y');
                            for ($year = $current_year; $year >= 1990; $year--) {
                                $selected = ($year == ($current_vehicle['year'] ?? '')) ? 'selected' : '';
                                echo "<option value='$year' $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="license_plate">License Plate</label>
                        <input type="text" id="license_plate" name="license_plate" required
                               value="<?= htmlspecialchars($current_vehicle['license'] ?? '') ?>"
                               class="vehicle-select" placeholder="e.g. ABC1234">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="cta-button">Update Information</button>
                    <a href="/account.php" class="cancel-button">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Model dependency script
    document.getElementById('vehicle_make').addEventListener('change', function() {
        const make = this.value;
        const modelSelect = document.getElementById('vehicle_model');
        
        if (!make) {
            modelSelect.disabled = true;
            modelSelect.innerHTML = '<option value="">Select Model</option>';
            return;
        }
        
        // Simple model database
        const models = {
            'Toyota': ['Camry', 'Corolla', 'RAV4', 'Prius', 'Highlander'],
            'Honda': ['Accord', 'Civic', 'CR-V', 'Pilot', 'Odyssey'],
            'Ford': ['F-150', 'Escape', 'Explorer', 'Mustang', 'Focus'],
            'Chevrolet': ['Silverado', 'Equinox', 'Malibu', 'Tahoe', 'Camaro'],
            'Nissan': ['Altima', 'Rogue', 'Sentra', 'Pathfinder', 'Maxima']
        };
        
        modelSelect.disabled = false;
        modelSelect.innerHTML = '<option value="">Select Model</option>';
        
        models[make].forEach(model => {
            const selected = model === '<?= $current_vehicle['model'] ?? '' ?>' ? 'selected' : '';
            modelSelect.innerHTML += `<option value="${model}" ${selected}>${model}</option>`;
        });
    });

    // Trigger change event if make is already selected
    const currentMake = '<?= $current_vehicle['make'] ?? '' ?>';
    if (currentMake) {
        document.getElementById('vehicle_make').dispatchEvent(new Event('change'));
    }
    </script>

    <?php include_once("footer.php"); ?>
</body>
</html>