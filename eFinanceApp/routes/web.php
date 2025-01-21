<?php
require_once 'config/config.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/LoanController.php'; 

$HomeController = new HomeController();
$UserController = new UserController($pdo);
$LoanController = new LoanController($pdo);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/eFinanceApp/') {
    $HomeController->index();
} 

else if ($uri === '/eFinanceApp/login.php') {
    $HomeController->login_page();
} 
else if ($uri === '/eFinanceApp/processLogin.php') {
    $HomeController->login_check();
} 
else if ($uri === '/eFinanceApp/dashboard.php') {
    $HomeController->dashboard();
} 
else if ($uri === '/eFinanceApp/profile.php') {
    $UserController->profile();
} 
else if ($uri === '/eFinanceApp/update_profile.php') {
    $UserController->updateProfile();
} 
else if ($uri === '/eFinanceApp/fund_transfer.php') {
    $UserController->fund_transfer();
} 
else if ($uri === '/eFinanceApp/check_duplicate.php') {
    $UserController->check_duplicate();
} 
else if ($uri === '/eFinanceApp/transactions.php') {
    $UserController->transaction();
} 
else if ($uri === '/eFinanceApp/logout.php') {
    $UserController->logout();
} 

elseif ($uri === '/eFinanceApp/signup' || $uri === '/eFinanceApp/signup.php') {
    $HomeController->signup_page();
} 

else if ($uri === '/eFinanceApp/loan_view.php') {
    $LoanController->viewLoans();  
} 
else if ($uri === '/eFinanceApp/loan_add.php') {
    $LoanController->addLoanPage();
} 
else if ($uri === '/eFinanceApp/approveLoan.php') {
    $LoanController->approveLoan();
} 
else if ($uri === '/eFinanceApp/rejectLoan.php') {
    $LoanController->rejectLoan();
} 

else {
    echo "404 Not Found";
}
?>
