<?php
session_start();
if(!empty($_SESSION))
{
    ?>
    <style>
        div{
            width: 50%;
        }
    </style>
    <div>User's Home Page</div>
    <br>
    <div>
        Welcome, <?php echo $_SESSION['name']?>
       
        <br><br>

        <table>
            <tr>
                <td><a href="profile.php">Profile</a></td>
            </tr>
            <tr>
                <td><a href="change_password.php">Change Password</a></td>
            </tr>
            <tr>
                <td><a href="logout.php">Logout</a></td>
            </tr>
        </table>
    </div>
    <?php
}else{
    header("Location: logout.php");
    exit;
}
?>