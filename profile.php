<?php
session_start();
if(!empty($_SESSION))
{
    ?>    
    <div>
        <table border=1>
            <tr>
                <td colspan="2">Profile</td>
            </tr>
            <tr>
                <td>ID</td>
                <td><?php echo $_SESSION['user_id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $_SESSION['user_id'];?></td>
            </tr>
            <tr>
                <td>User Type</td>
                <td><?php echo $_SESSION['userType'];?></td>
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
    </div>
    <?php
}else{
    header();
    exit;
}
?>