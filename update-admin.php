<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1><br><br>

        <?php

        //1.get the id
        $id = $_GET['id'];

        //2.create sql query to get the details
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";

        //3.execute the qeury

        $res = mysqli_query($conn,$sql);

        if($res == true){
            $count = mysqli_num_rows($res);
            //check wehether we have admin data or not
            if($count ==1){
                //get the details
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['user_name'];
            }
            else{
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
      



        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full name: </td>
                <td>
                    <input type="text" name = "full_name" value="<?php echo $full_name; ?>">
                </td>
            </tr>
            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="user_name" value="<?php echo $username; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                    <input type="submit" name = "submit" value = "update admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php

//checking whether the submit button is clicked or not
if(isset($_POST['submit']))
{
   //get all the values from form to update
   $id =$_POST['id'];
   $full_name = $_POST['full_name'];
   $username = $_POST['user_name'];

   $sql = "UPDATE tbl_admin SET 
   full_name = '$full_name',
   user_name='$username'
   WHERE id = '$id'
   ";

   //execute the query
   $res = mysqli_query($conn,$sql);

   if($res ==true){
    $_SESSION['update'] = "<div style= 'color:#009432;'><b>Admin Updated Successfully</b></div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else{
    $_SESSION['update']= "<div style= 'color:red;'><b>failed to update admin</b></div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

   }
}

?>




<?php include('partials/footer.php') ?>