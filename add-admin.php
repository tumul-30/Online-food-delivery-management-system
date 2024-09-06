<?php include('<partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>

        <?php 

            if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session message
            } 
        
        ?>

        <form action="" method="POST">

        <table width=30%>
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="enter your name"></td>
            </tr>

            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="enter your username"></td>
            </tr>

            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" ></td>
            </tr>
        
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>


        </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php'); ?>

<?php 

//process the value from form and save it in database
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //button clicked
//1.get data from form

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$password= md5($_POST['password']);//md5 used for password encryption

//2.SQL query to save data into database
$sql = "INSERT INTO tbl_admin SET 
full_name = '$full_name',
user_name = '$username',
password='$password'";

//3. execute query and save data in database
$res = mysqli_query($conn, $sql) or die(mysqli_error());

//4.check whether the data(query is executed) is inserted or not and dsiplay appropriate message
if($res == TRUE){
    //data inserted
    $_SESSION['add'] = "(Admin Added successfully)";
    //redirect page
    header("location:".SITEURL.'admin/manage-admin.php');
}
else{
    $_SESSION['add'] = "failed to add admin";
    //redirect page
    header("location:".SITEURL.'admin/add-admin.php');
}
}




?>