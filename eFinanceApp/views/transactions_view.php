<?php
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Initialize total amount
$totalAmount = 0;

// Assuming $transactions is an array of transaction data
if (!empty($transactions)) {
    foreach ($transactions as $transaction) {
        $totalAmount += $transaction['amount'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History | eFinanceApp</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Add your styles here */
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

        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            margin-bottom: 0;
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            padding: 15px;
        }

        td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f7ff;
        }

        .btn-download {
            display: inline-block;
            margin-bottom: 20px;
            background: #007bff;
            color: #fff;
            border: none;
            font-size: 16px;
            font-weight: bold;
            padding: 12px 25px;
            border-radius: 8px;
            text-align: center;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .btn-download:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #6c757d;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .search-form input, .search-form select {
            margin-right: 10px;
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
            <a class="nav-link active" href="transactions.php"><i class="fa fa-exchange"></i> Transactions</a>
            <a class="nav-link" href="fund_transfer.php"><i class="fa fa-credit-card"></i> Fund Transfer</a>
            <a class="nav-link" href="settings.php"><i class="fa fa-cogs"></i> Settings</a>
            <a class="nav-link logout-btn" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <div class="title text-center mb-4">
                <i class="fa fa-database"></i> Transaction History
            </div>

            <!-- Search Form -->
            <form method="get" action="transactions.php" class="search-form mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="transaction_type" class="form-control">
                            <option value="">All</option>
                            <option value="credit" <?php echo isset($_GET['transaction_type']) && $_GET['transaction_type'] == 'credit' ? 'selected' : ''; ?>>Credit</option>
                            <option value="debit" <?php echo isset($_GET['transaction_type']) && $_GET['transaction_type'] == 'debit' ? 'selected' : ''; ?>>Debit</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <?php if (!empty($transactions)): ?>
                <div class="total-amount">
                    Total Amount: ৳<?php echo number_format($totalAmount, 2); ?>
                </div>
            <?php endif; ?>

            <div class="table-container">
                <?php if (!empty($transactions)): ?>
                    <button id="downloadBtn" class="btn-download"><i class="fa fa-download me-2"></i>Download as TXT</button>
                <?php endif; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>To User</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Sent At</th>
                            <th>Received At</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTable">
                        <?php if (!empty($transactions)): ?>
                            <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['receiver_name']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['transaction_type']); ?></td>
                                <td>৳<?php echo htmlspecialchars(number_format($transaction['amount'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($transaction['sent_at']))); ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($transaction['received_at']))); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            &copy; 2025 eFinanceApp | All Rights Reserved
        </footer>
    </div>

    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('downloadBtn')?.addEventListener('click', function () {
            const table = document.querySelector('#transactionTable');
            const rows = Array.from(table.querySelectorAll('tr'));

            const columnWidths = [20, 20, 10, 30, 25, 25];
            let text = "";

            const formatCell = (content, width) => content.padEnd(width).substring(0, width);

            text +=
                formatCell("To User", columnWidths[0]) +
                formatCell("Transaction Type", columnWidths[1]) +
                formatCell("Amount", columnWidths[2]) +
                formatCell("Description", columnWidths[3]) +
                formatCell("Sent At", columnWidths[4]) +
                formatCell("Received At", columnWidths[5]) +
                "\n";

            text += "-".repeat(columnWidths.reduce((a, b) => a + b)) + "\n";

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    text +=
                        formatCell(cells[0].textContent.trim(), columnWidths[0]) +
                        formatCell(cells[1].textContent.trim(), columnWidths[1]) +
                        formatCell(cells[2].textContent.trim(), columnWidths[2]) +
                        formatCell(cells[3].textContent.trim(), columnWidths[3]) +
                        formatCell(cells[4].textContent.trim(), columnWidths[4]) +
                        formatCell(cells[5].textContent.trim(), columnWidths[5]) +
                        "\n";
                }
            });

            const blob = new Blob([text], { type: 'text/plain' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);

            const now = new Date();
            const dateStr = now.toLocaleDateString('en-GB').replace(/\//g, '') + now.toLocaleTimeString('en-GB').replace(/:/g, '');

            link.download = `TH_${dateStr}.txt`;

            link.click();
        });
    </script>
</body>
</html>
