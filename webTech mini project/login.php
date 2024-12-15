<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $password = $_POST['password'];

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    $isAuthenticated = false;
    foreach ($users as $user) {
        list($storedId, $storedPassword, $name, $userType) = explode('|', $user);

        if ($storedId === $id && $storedPassword === $password) {
            $isAuthenticated = true;
            break;
        }
    }

    if ($isAuthenticated) {

        $_SESSION['user_id'] = $_POST['id'];
        $_SESSION['name'] = $name;
        $_SESSION['password'] = $password;
        $_SESSION['userType'] = $userType;

        if($userType == "User")
        {
            header("Location: user_home.php");
            exit();
        }else{
            header("Location: admin_home.php");
            exit();
        }
        echo "Login successful!";
    } else {
        echo "Invalid username or password!";
    }
}
?>

<style>
    fieldset{
        width: 150px;
    }
    legend{
        font-weight:bold;
        font-size: 18px;
    }
</style>

<fieldset>
    <legend>LOGIN</legend>
    <form method="POST">
        <label for="id">User Id</label><br>
        <input type="text" name="id" required><br>
    
        <label for="password">Password</label><br>
        <input type="password" name="password" required><br> <br>
    
        <input type="submit" value="Login"> &nbsp;&nbsp;&nbsp;&nbsp; <a href="signup.php">Register</a>
    </form>
</fieldset>


