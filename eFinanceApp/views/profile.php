<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user is not authenticated
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../config/config.php';  

// Handle form submission if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'mobile_no' => $_POST['mobile_no'],
        'address' => $_POST['address'],
        'gender' => $_POST['gender'],
        'dob' => $_POST['dob']
    ];

    // Handle the profile image upload
    $file = $_FILES;

    // Call the updateProfile method from the controller
    $response = $UserController->updateProfile($data, $file);
    $response = json_decode($response, true); // Decode JSON response

    // Show response message
    if ($response['status'] === 'success') {
        echo '<div class="alert alert-success">' . $response['message'] . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . $response['message'] . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | eFinanceApp</title>

    <!-- Bootstrap and FontAwesome -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/font-awesome.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #ddd;
            font-size: 1.1rem;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center text-white">eFinanceApp</h3>
        <nav class="nav flex-column">
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
            <a class="nav-link active" href="profile.php"><i class="fa fa-user"></i> Profile</a>
            <a class="nav-link" href="transactions.php"><i class="fa fa-exchange"></i> Transactions</a>
            <a class="nav-link" href="fund_transfer.php"><i class="fa fa-credit-card"></i> Fund Transfer</a>
            <a class="nav-link" href="settings.php"><i class="fa fa-cogs"></i> Settings</a>
            <a class="nav-link logout-btn" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </nav>
    </div>

    <div class="content">
        <div class="container">
            <h1>Profile Information</h1>
            <p>Balance: <?= number_format($_SESSION["balance"], 2, '.', ',') ?></p>
            
            <div class="row">
                <div class="col-md-4 text-center">
                    <!-- Display profile image -->
                    <img src="uploads/pro_pic/<?= htmlspecialchars($_SESSION['profile_img']) ?>" alt="Profile Image" class="profile-img">

                    <!-- Profile Image Upload Form -->
                    <form id="profileImgForm" method="POST" enctype="multipart/form-data">
                        <input type="file" name="profile_img" accept="image/*" class="form-control mb-3">
                        <button type="submit" class="btn btn-custom">Upload New Image</button>
                    </form>
                </div>

                <div class="col-md-8">
                    <!-- Profile Information Update Form -->
                    <form id="profileForm" method="POST">
                        <input type="hidden" name="action" value="update_profile">
                        
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($_SESSION['name']) ?>" required>
                            <div class="error" id="nameError"></div>
                        </div>
                        
                        <!-- Username Field -->
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($_SESSION['username']) ?>" required>
                            <div class="error" id="usernameError"></div>
                        </div>
                        
                        <!-- Mobile No Field -->
                        <div class="mb-3">
                            <label for="mobile_no">Mobile No</label>
                            <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?= htmlspecialchars($_SESSION['mobile_no']) ?>" required>
                            <div class="error" id="mobileNoError"></div>
                        </div>
                        
                        <!-- Address Field -->
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($_SESSION['address']) ?>" required>
                            <div class="error" id="addressError"></div>
                        </div>
                        
                        <!-- Gender Field -->
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male" <?= ($_SESSION['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($_SESSION['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                            </select>
                            <div class="error" id="genderError"></div>
                        </div>
                        
                        <!-- Date of Birth Field -->
                        <div class="mb-3">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="<?= htmlspecialchars(substr($_SESSION['dob'], 0, 10)) ?>" required>
                            <div class="error" id="dobError"></div>
                        </div>

                        <!-- Update Profile Button -->
                        <button type="submit" class="btn btn-custom">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add blur validation for all fields
            $('#name').blur(function() {
                if ($(this).val().trim() === '') {
                    $('#nameError').text('Name is required.');
                } else {
                    $('#nameError').text('');
                }
            });

            $('#username').blur(function() {
                if ($(this).val().trim() === '') {
                    $('#usernameError').text('Username is required.');
                } else {
                    $('#usernameError').text('');
                }
            });

            $('#mobile_no').blur(function() {
                var mobile = $(this).val().trim();
                // Regex to check if the number is 11 digits and starts with the specified prefixes
                var mobileRegex = /^(017|013|015|016|018|019)\d{7}$/;

                if (mobile === '') {
                    $('#mobileNoError').text('Mobile number is required.');
                } else if (!mobileRegex.test(mobile)) {
                    $('#mobileNoError').text('Mobile number must be 11 digits long and start with 017, 013, 015, 016, 018, or 019.');
                } else {
                    $('#mobileNoError').text('');
                }
            });

            $('#address').blur(function() {
                if ($(this).val().trim() === '') {
                    $('#addressError').text('Address is required.');
                } else {
                    $('#addressError').text('');
                }
            });

            $('#gender').blur(function() {
                if ($(this).val() === '') {
                    $('#genderError').text('Gender is required.');
                } else {
                    $('#genderError').text('');
                }
            });

            $('#dob').blur(function() {
                if ($(this).val() === '') {
                    $('#dobError').text('Date of birth is required.');
                } else {
                    $('#dobError').text('');
                }
            });
        });
    </script>
</body>
</html>
