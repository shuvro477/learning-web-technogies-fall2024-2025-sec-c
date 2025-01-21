<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=efinance_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['id'];
    $recipient_id = $_POST['recipient_id'];
    $amount = $_POST['amount'];

    if ($amount <= 0) {
        $message = "Please enter a valid amount.";
    } elseif ($amount < 10) {
        $message = "Transfer amount must be at least 10.";
    } else {
        try {
            // Begin transaction
            $pdo->beginTransaction();

            // Check sender balance
            $stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
            $stmt->execute([$sender_id]);
            $sender = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($sender && $sender['balance'] >= $amount) {
                // Deduct amount from sender
                $stmt = $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
                $stmt->execute([$amount, $sender_id]);

                // Add amount to recipient
                $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
                $stmt->execute([$amount, $recipient_id]);

                // Insert the transaction log
                $stmt = $pdo->prepare("INSERT INTO transaction_logs (
                    user_id,
                    to_user_id,
                    transaction_type,
                    amount,
                    description,
                    sent_at,
                    received_at
                ) VALUES (?, ?, 'credit', ?, 'Fund Transfer', NOW(), NOW())");

                $stmt->execute([$sender_id, $recipient_id, $amount]);

                // Commit transaction
                $pdo->commit();
                $message = "Fund transfer successful!";
            } else {
                $message = "Insufficient balance.";
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            $message = "An error occurred: " . $e->getMessage();
        }
    }
}

// Fetch all users except the logged-in user for the recipient dropdown
$stmt = $pdo->prepare("SELECT id, username, name FROM users WHERE id != ?");
$stmt->execute([$_SESSION['id']]);
$recipients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the sender's balance
$stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$sender = $stmt->fetch(PDO::FETCH_ASSOC);
$sender_balance = $sender['balance'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Transfer | eFinanceApp</title>
    <!-- Bootstrap CSS (Local) -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS (Local) -->
    <link href="public/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">eFinanceApp</h3>
        <nav class="nav flex-column">
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard</a>
            <a class="nav-link" href="profile.php"><i class="fa fa-user"></i> Profile</a>
            <a class="nav-link" href="transactions.php"><i class="fa fa-exchange"></i> Transactions</a>
            <a class="nav-link active" href="fund_transfer.php"><i class="fa fa-credit-card"></i> Fund Transfer</a>
            <a class="nav-link" href="settings.php"><i class="fa fa-cogs"></i> Settings</a>
            <a class="nav-link logout-btn" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h1 class="text-center">Fund Transfer</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Transfer Money</h5>

                    <!-- Display message -->
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <form id="fundTransferForm" method="POST">
                        <div class="mb-3">
                            <label for="recipient_id" class="form-label">Recipient</label>
                            <select name="recipient_id" id="recipient_id" class="form-control" required>
                                <option value="">Select recipient</option>
                                <?php foreach ($recipients as $recipient) : ?>
                                    <option value="<?= htmlspecialchars($recipient['id']) ?>">
                                        <?= htmlspecialchars($recipient['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="10" required>
                        </div>

                        <input type="hidden" id="senderBalance" value="<?= htmlspecialchars($sender_balance); ?>">

                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Local) -->
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("fundTransferForm").addEventListener("submit", function (e) {
                const senderBalance = parseFloat(document.getElementById("senderBalance").value);
                const transferAmount = parseFloat(document.getElementById("amount").value);
                const minAmount = 10;

                if (transferAmount < minAmount) {
                    alert(`Amount must be at least ${minAmount}.`);
                    e.preventDefault();
                } else if (transferAmount > senderBalance) {
                    alert("Transfer amount exceeds available balance.");
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
