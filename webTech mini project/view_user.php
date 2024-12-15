<?php
session_start();
if(!empty($_SESSION))
{
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    ?>    
    <div>
        <table border=1>
            <tr>
                <td colspan="3">Users</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>User Type</td>
            </tr>
            <?php
            foreach ($users as $user) {
                list($id, $password, $name, $userType) = explode('|', $user);
                $tr_row = '<tr>';
                $tr_row .='<td>' . htmlspecialchars($id) . '</td>';
                $tr_row .='<td>' . htmlspecialchars($name) . '</td>';
                $tr_row .='<td>' . htmlspecialchars($userType) . '</td>';
                $tr_row .='</tr>';

                echo $tr_row;
            }
            ?>
            <tr>
                <td colspan="3"><a href="admin_home.php">Go Home</a></td>
            </tr>
        </table>
    </div>
    <?php
}else{
    header();
    exit;
}
?>