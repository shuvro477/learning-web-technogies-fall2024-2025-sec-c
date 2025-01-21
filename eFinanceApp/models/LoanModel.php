<?php
// Loan.php
class LoanModel {
    private $id;
    private $user_id;
    private $loan_type;
    private $amount;
    private $interest_rate;
    private $term;
    private $start_date;
    private $end_date;
    private $status;

    public function __construct($id, $user_id, $loan_type, $amount, $interest_rate, $term, $start_date, $end_date, $status) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->loan_type = $loan_type;
        $this->amount = $amount;
        $this->interest_rate = $interest_rate;
        $this->term = $term;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->status = $status;
    }

    // Getter methods
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getLoanType() {
        return $this->loan_type;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getInterestRate() {
        return $this->interest_rate;
    }

    public function getTerm() {
        return $this->term;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function getEndDate() {
        return $this->end_date;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setter methods
    public function setStatus($status) {
        $this->status = $status;
    }
}
?>
