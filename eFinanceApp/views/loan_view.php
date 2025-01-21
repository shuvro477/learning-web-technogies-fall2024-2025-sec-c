<?php
session_start();
require_once __DIR__ . '/../controllers/LoanController.php';
require_once __DIR__ . '/../config/config.php';


$loanController = new LoanController($pdo);
$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitLoan'])) {
    $loanType = $_POST['loan_type'];
    $amount = $_POST['amount'];
    $interestRate = $_POST['interest_rate'];
    $term = $_POST['term'];

    $message = $loanController->addLoan($userId, $loanType, $amount, $interestRate, $term);
}

$loans = $loanController->viewLoans($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management | eFinanceApp</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Loan Management</h1>

        <!-- Add Loan Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="loan_type" class="form-label">Loan Type</label>
                <input type="text" class="form-control" id="loan_type" name="loan_type" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Loan Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="mb-3">
                <label for="interest_rate" class="form-label">Interest Rate</label>
                <input type="number" class="form-control" id="interest_rate" name="interest_rate" required>
            </div>
            <div class="mb-3">
                <label for="term" class="form-label">Term (Months)</label>
                <input type="number" class="form-control" id="term" name="term" required>
            </div>
            <button type="submit" name="submitLoan" class="btn btn-primary">Submit Loan</button>
        </form>

        <!-- Message -->
        <?php if (isset($message)) : ?>
            <div class="alert alert-info mt-3"><?php echo $message; ?></div>
        <?php endif; ?>

        <h2 class="mt-5">Your Loans</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?php echo htmlspecialchars($loan['loan_type']); ?></td>
                    <td><?php echo "৳" . number_format($loan['amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($loan['status']); ?></td>
                    <td>
                        <?php if ($loan['status'] == 'pending'): ?>
                            <a href="approveLoan.php?id=<?php echo $loan['id']; ?>" class="btn btn-success">Approve</a>
                            <a href="rejectLoan.php?id=<?php echo $loan['id']; ?>" class="btn btn-danger">Reject</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
