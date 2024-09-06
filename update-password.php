<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
             
        </form>
    </div>
</div>

<?php

//1.check if the submit button is clicked or not
if(isset($_POST['submit'])){
    //1. get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //2.check whether the user with curretn id and current passwod exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    if($res ==true){
        //check whether data is available or not
        $count = mysqli_num_rows($res);

        if($count==1){
            //user exists

           if($new_password==$confirm_password){
            //update the password
            $sql2 = "UPDATE tbl_admin SET
            password = '$new_password' WHERE id = $id";

            $res2 = mysqli_query($conn , $sql2);

            if($res2==true){
                $_SESSION['change-pwd'] = "<div style= 'color:#009432;'><b>PASSWORD CHANGED SUCCESSFULLY</b></div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else{
                $_SESSION['change-pwd'] = "<div style= 'color:red;'><b>Failed to update password</b></div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
            }
           }
           else{
            $_SESSION['pwd-not-match'] = "<div style= 'color:red;'><b>PASSWORD DID NOT MATCH</b></div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
           }
            
        }
        else{

            $_SESSION['user-not-found'] = "<div style= 'color:red;'><b>USER NOT FOUND</b></div>";
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }

    //3. check whether the new password and confirm password match or not

    //4.change password if all above is true
}

?>



<?php include('partials/footer.php'); ?>