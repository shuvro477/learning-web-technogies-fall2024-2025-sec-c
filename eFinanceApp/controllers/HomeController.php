<?php
class HomeController {

    
    public function index() {
        require_once 'views/home.php';
    }

    public function login_page()
    {
        require_once "views/login.php";
    }

    public function login_check()
    {
        require_once 'models/UserModel.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new UserModel();

        if ($userModel->validateUser($username, $password)) 
        {            
            // echo "<pre>";print_r($_SESSION);exit;
            header('Location: dashboard.php');
        } else {
            // Show error message if login fails
            echo "Invalid username or password.";
        }
    }

    public function dashboard()
    {
        session_start();


        // Check if the user is logged in
        if (!isset($_SESSION['id'])) {
            header("Location: login.php");
            exit();
        }

        require_once 'views/dashboard.php';
    }

    public function signup_page()
    {
        require_once "views/login.php";
    }
}

?>