<?php
if (!empty($_POST)) 
{
    $id = $_POST['id'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $name = $_POST['name'];
    $userType = $_POST['userType'];

    if ($password === $confirmPassword)
    {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES);
        $isUserExists = false;
        foreach ($users as $user) 
        {
            list($storedId, $storedPassword, $storedName, $storedUserType) = explode('|', $user);
            if ($storedId === $id) 
            {
                $isUserExists = true;
                break;
            }
        }

        if ($isUserExists) {
            echo "This ID is already taken. Please choose another one.";
        } else {
            $userData = "$id|$password|$name|$userType\n";
            file_put_contents('users.txt', $userData, FILE_APPEND);
            header("Location: login.php");
            exit();
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>
<style>
    fieldset{
        width: 150px;
    }
    legend{
        font-weight:bold;
        font-size: 24px;
    }
</style>
<fieldset>
    <legend>Registration</legend>
    <form method="POST">
        <label for="id">Id</label><br>
        <input type="text" name="id" required><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" required><br>

        <label for="confirmPassword">Confirm Password</label><br>
        <input type="password" name="confirmPassword" required><br>

        <label for="name">Name</label><br>
        <input type="text" name="name" required><br>

        <label for="userType">User Type</label><br>
        
        <input type="radio" name="userType" value="User" checked>User
        <input type="radio" name="userType" value="Admin">Admin<br> <br>

        
        <input type="submit" value="Sign Up"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="login.php">Sign In</a>
    </form>
</fieldset>



