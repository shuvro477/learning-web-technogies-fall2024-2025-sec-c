<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST)) 
{
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($currentPassword == $_SESSION['password']) {
        if ($newPassword == $confirmPassword) 
        {
            echo "Password update successfully !";
        } 
        else {
            echo "New password and confirmation do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h1>Change Password</h1>
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="current_password">Current Password:</label></td>
                <td><input type="password" id="current_password" name="current_password" required></td>
            </tr>
            <tr>
                <td><label for="new_password">New Password:</label></td>
                <td><input type="password" id="new_password" name="new_password" required></td>
            </tr>
            <tr>
                <td><label for="confirm_password">Confirm New Password:</label></td>
                <td><input type="password" id="confirm_password" name="confirm_password" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="submit" value="Change Password">
                </td>
            </tr>
            <tr>
                <?php
                    if($_SESSION['userType'] == "User")
                    {
                        $home_page = "user_home.php";
                    }else{
                        $home_page = "admin_home.php";
                    }
                ?>
                <td colspan="2"><a href="<?php echo $home_page;?>">Go Home</a></td>
            </tr>
        </table>
    </form>
</body>
</html>
