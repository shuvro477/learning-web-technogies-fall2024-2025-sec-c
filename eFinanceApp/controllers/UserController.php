<?php
require 'config/config.php'; 
require_once 'models/UserModel.php';

class UserController {

    
    private $UserModel; 

    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->UserModel = new UserModel($pdo);
    }

    public function showProfile() {
        try {
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['id' => 1]); 

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                include '../views/profile.php'; // Pass data to the view if needed
            } else {
                echo "User not found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function check_duplicate()
    {
        if($_POST["table"] == "users")
        {
            if($_POST["column_name"] == "username")
            {
                
            }
        }
    }

    private function uploadProfileImage($file) {
        $targetDir = "uploads/pro_pic/";
        $fileName = uniqid() . "_" . basename($file["name"]);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($file["size"] > 2000000) {
            return ['status' => 'error', 'message' => 'File too large. Max size is 2MB.'];
        }
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            return ['status' => 'error', 'message' => 'Invalid file type.'];
        }
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return ['status' => 'success', 'file' => $fileName];
        }
        return ['status' => 'error', 'message' => 'Error uploading file.'];
    }

    public function updateProfile($data, $file) {
        $profileImg = $_SESSION['profile_img'];
    
        // Check if the image is uploaded
        if (!empty($file['profile_img']['name'])) {
            $uploadResult = $this->uploadProfileImage($file['profile_img']);
            if ($uploadResult['status'] === 'success') {
                $profileImg = $uploadResult['file']; // Update the profile image
            } else {
                return json_encode($uploadResult); // Return error if file upload fails
            }
        }
    
        // Prepare and execute the SQL update query for the user profile
        $query = "UPDATE users SET name = ?, username = ?, mobile_no = ?, address = ?, gender = ?, dob = ?, profile_img = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "sssssssi",
            $data['name'],
            $data['username'],
            $data['mobile_no'],
            $data['address'],
            $data['gender'],
            $data['dob'],
            $profileImg,
            $_SESSION['id'] // Assuming the session has the user id
        );
    
        if ($stmt->execute()) {
            // Update session data with the new profile information
            $_SESSION = array_merge($_SESSION, $data, ['profile_img' => $profileImg]);
            return json_encode(['status' => 'success', 'message' => 'Profile updated.']);
        }
        return json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
    }

    public function logout()
    {
        // Destroy session data
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // If cookies are set, expire them
        if (isset($_COOKIE['user_id'])) {
            setcookie('user_id', '', time() - 3600, '/');  // Expire the user_id cookie
        }
        if (isset($_COOKIE['username'])) {
            setcookie('username', '', time() - 3600, '/');  // Expire the username cookie
        }

        // Redirect to login page
        header("Location: login.php");
        exit();
    }

   
    public function profile()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            header("Location: login.php");
            exit();
        }

        require_once 'views/profile.php';
    }

    function fund_transfer()
    {
        require_once 'views/fund_transfer.php';
    }

    public function transaction_old($pdo)
    {
        $transactions = $this->UserModel->getTransactions($pdo);
        include 'views/transactions_view.php';
    }

    public function transaction($pdo)
    {
        $transactionType = isset($_GET['transaction_type']) ? $_GET['transaction_type'] : '';
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        $transactions = $this->UserModel->getTransactions($pdo, $transactionType, $startDate, $endDate);
        include 'views/transactions_view.php';
    }


}

?>