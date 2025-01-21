<?php
require_once __DIR__ . '/../config/config.php';  // Ensure config is included for $pdo


class LoanController {
    private $pdo;

    // Constructor accepts $pdo and assigns it to the class variable
    public function __construct($pdo) {
        $this->pdo = $pdo;  
    }

    // View loans - no need to pass $pdo again since it's already in the class
    public function viewLoans() {
        $stmt = $this->pdo->prepare("SELECT * FROM loans");
        $stmt->execute();
        $loans = $stmt->fetchAll();
       
        include 'views/loan_view.php';  // Your view for displaying loans
    }

    // Show add loan page (no $pdo needed here)
    public function addLoanPage() {
        include 'views/loan_add.php';  // Your view for adding loans
    }

    // Approve loan - no need to pass $pdo here, it will be used from the class
    public function approveLoan($loan_id) {
        $stmt = $this->pdo->prepare("UPDATE loans SET status = 'approved' WHERE id = ?");
        $stmt->execute([$loan_id]);
       
        header('Location: loan_view.php');
    }

    // Reject loan - same as above, use $pdo from the class
    public function rejectLoan($loan_id) {
        $stmt = $this->pdo->prepare("UPDATE loans SET status = 'rejected' WHERE id = ?");
        $stmt->execute([$loan_id]);
       
        header('Location: loan_view.php');
    }
}

?>
