<?php
// Redirect to login page if the user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">eFinanceApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account_summary.php">Account Summary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transactions.php">Transaction History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="fund_transfer.php">Fund Transfer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
