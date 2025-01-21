<?php
require_once __DIR__ . '/../config/config.php';


class UserModel {
    
    public function validateUser($username, $password)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]); // Pass both username and password
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) 
        {
            session_start();

            foreach ($user as $key => $value) {
                $_SESSION[$key] = $value;
            }

            return true;
        }

        return false; // Invalid credentials if no user is found

    }

    public function getTransactions($pdo, $transactionType = '', $startDate = '', $endDate = '')
    {
        session_start();
        $userId = $_SESSION['id'];

        // Base query
        $query = "
            SELECT 
                transaction_logs.*, 
                sender.name AS sender_name, 
                sender.username AS sender_username, 
                receiver.name AS receiver_name, 
                receiver.username AS receiver_username
            FROM 
                transaction_logs
            LEFT JOIN 
                users AS sender 
            ON 
                transaction_logs.user_id = sender.id
            LEFT JOIN 
                users AS receiver 
            ON 
                transaction_logs.to_user_id = receiver.id
            WHERE 
                (transaction_logs.user_id = :user_id OR transaction_logs.to_user_id = :user_id)
        ";

        // Filters
        if ($transactionType) {
            if ($transactionType == 'credit') {
                $query .= " AND transaction_logs.to_user_id = :user_id";
            } elseif ($transactionType == 'debit') {
                $query .= " AND transaction_logs.user_id = :user_id";
            }
        }

        if ($startDate && $endDate) {
            $query .= " AND transaction_logs.sent_at BETWEEN :start_date AND :end_date";
        }

        $query .= " ORDER BY transaction_logs.sent_at DESC";

        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        if ($startDate && $endDate) {
            $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $endDate, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>