<?php
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | eFinanceApp</title>
    <!-- Bootstrap CSS (Local) -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS (Local) -->
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

        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .welcome-header {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .card {
            border-radius: 15px;
        }

        .alert-primary {
            background-color: #cce5ff;
            border-color: #b8daff;
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .logout-btn {
            background-color: #dc3545;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">eFinanceApp</h3>
        <nav class="nav flex-column">
            <a class="nav-link active" href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
            <a class="nav-link" href="profile.php"><i class="fa fa-user"></i> Profile</a>
            <a class="nav-link" href="transactions.php"><i class="fa fa-exchange"></i> Transactions</a>
            <a class="nav-link" href="fund_transfer.php"><i class="fa fa-credit-card"></i> Fund Transfer</a>
            <a class="nav-link" href="loan_view.php"><i class="fa fa-cogs"></i> Settings</a>
            <a class="nav-link logout-btn" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <!-- Profile Image -->
            <div class="text-center">
                <?php if (isset($_SESSION['profile_img']) && !empty($_SESSION['profile_img'])): ?>
                    <img src="uploads/pro_pic/<?php echo htmlspecialchars($_SESSION['profile_img']); ?>" alt="Profile Image" class="profile-img mb-4">
                <?php else: ?>
                    <img src="https://via.placeholder.com/100" alt="Profile Image" class="profile-img mb-4">
                <?php endif; ?>
            </div>

            <h1 class="welcome-header">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>You are logged in as user ID: <?php echo htmlspecialchars($_SESSION['id']); ?></p>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Account Overview</h5>
                            <p>Your account is active and ready to use. Explore the eFinance features from the menu.</p>
                            <a href="profile.php" class="btn-custom">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Transactions</h5>
                            <p>Check your recent transactions and activity below.</p>
                            <a href="transactions.php" class="btn-custom">View Transactions</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-primary mt-5">
                <h4>eFinance Tasks</h4>
                <p>Use the navigation menu on the left to access your account summary, transaction history, fund transfers, and profile settings.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Local) -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
