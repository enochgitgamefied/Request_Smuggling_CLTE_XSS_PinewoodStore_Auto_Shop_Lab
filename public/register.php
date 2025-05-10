<?php
require_once 'config.php'; // Contains the session config

$title = "Register | PinewoodStore Auto Shop";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=mysql;dbname=pinewood_autoshop", "root", "secret");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $make = $_POST['vehicle_make'];
        $model = $_POST['vehicle_model'];
        $year = $_POST['vehicle_year'];
        $license = $_POST['license_plate'];

        // Validate inputs
        if (empty($name) || empty($email) || empty($password) || empty($make) || empty($model) || empty($year) || empty($license)) {
            $_SESSION['error'] = "All fields are required";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Format vehicle info
            $vehicle_info = "$year $make $model - $license";

            // Insert user
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, vehicle_info) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashedPassword, $vehicle_info]);

            // Set success flag for JavaScript
            $_SESSION['registration_success'] = true;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Registration error: " . $e->getMessage();
    }
}

include_once("_header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/css/register.css">
    <style>
        .vehicle-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .form-actions {
            margin-top: 20px;
        }

        /* Popup styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 5px;
            text-align: center;
        }

        .modal-ok {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Success Popup Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h3>Registration Successful!</h3>
            <p>Your account has been created successfully.</p>
            <button class="modal-ok" onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <img src="/images/autoshop.png" alt="PinewoodStore Auto Shop">
                <h2>Create Account</h2>
                <p>Track your vehicle services and appointments</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" class="register-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required
                        value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <h3>Vehicle Information</h3>

                <div class="form-group">
                    <label for="vehicle_make">Vehicle Make</label>
                    <select id="vehicle_make" name="vehicle_make" required class="vehicle-select">
                        <option value="">Select Make</option>
                        <option value="Toyota" <?= isset($_POST['vehicle_make']) && $_POST['vehicle_make'] === 'Toyota' ? 'selected' : '' ?>>Toyota</option>
                        <option value="Honda" <?= isset($_POST['vehicle_make']) && $_POST['vehicle_make'] === 'Honda' ? 'selected' : '' ?>>Honda</option>
                        <option value="Ford" <?= isset($_POST['vehicle_make']) && $_POST['vehicle_make'] === 'Ford' ? 'selected' : '' ?>>Ford</option>
                        <option value="Chevrolet" <?= isset($_POST['vehicle_make']) && $_POST['vehicle_make'] === 'Chevrolet' ? 'selected' : '' ?>>Chevrolet</option>
                        <option value="Nissan" <?= isset($_POST['vehicle_make']) && $_POST['vehicle_make'] === 'Nissan' ? 'selected' : '' ?>>Nissan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vehicle_model">Vehicle Model</label>
                    <select id="vehicle_model" name="vehicle_model" required class="vehicle-select" disabled>
                        <option value="">Select Model</option>
                        <?php if (isset($_POST['vehicle_make'])): ?>
                            <script>
                                // Trigger model population if form was submitted with errors
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('vehicle_make').dispatchEvent(new Event('change'));
                                    // Set previously selected model if available
                                    const previousModel = '<?= $_POST['vehicle_model'] ?? '' ?>';
                                    if (previousModel) {
                                        setTimeout(() => {
                                            document.getElementById('vehicle_model').value = previousModel;
                                        }, 100);
                                    }
                                });
                            </script>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="vehicle_year">Year</label>
                    <select id="vehicle_year" name="vehicle_year" required class="vehicle-select">
                        <option value="">Select Year</option>
                        <?php
                        $current_year = date('Y');
                        $selected_year = $_POST['vehicle_year'] ?? '';
                        for ($year = $current_year; $year >= 1990; $year--) {
                            $selected = $selected_year == $year ? 'selected' : '';
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="license_plate">License Plate</label>
                    <input type="text" id="license_plate" name="license_plate" required
                        value="<?= isset($_POST['license_plate']) ? htmlspecialchars($_POST['license_plate']) : '' ?>"
                        placeholder="e.g. ABC1234">
                </div>

                <div class="form-actions">
                    <button type="submit" class="cta-button">Create Account</button>
                </div>
            </form>

            <div class="register-footer">
                <p>Already have an account? <a href="/login.php">Sign in</a></p>
            </div>
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
                modelSelect.innerHTML += `<option value="${model}">${model}</option>`;
            });
        });

        // Success modal handling
        function redirectToLogin() {
            window.location.href = '/login.php';
        }

        // Check if registration was successful
        <?php if (isset($_SESSION['registration_success'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('successModal').style.display = 'block';
            });
            <?php unset($_SESSION['registration_success']); ?>
        <?php endif; ?>
    </script>

    <?php include_once("footer.php"); ?>
</body>

</html>