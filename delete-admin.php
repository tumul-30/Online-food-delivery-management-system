<?php 
include('../config/const.php');

//1.get the id of admin to be deleted
 $id = $_GET['id'];
//2.create sql query to delete

$sql = "DELETE FROM tbl_admin WHERE id = $id";

//execute the query

$res = mysqli_query($conn, $sql);

//check wheter the quqey executed successfully
if($res == true){
    //session variable to display the message
    $_SESSION['delete']= "<div style= 'color:#009432;'><b>Admin deleted successfully</b></div>";
    header('location:'.SITEURL.'admin/manage-admin.php');//redirect to home page
}
else{
    $_SESSION['delete']= "<div style= 'color:red;'><b>failed to delete admin</b></div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
//3.redirect to manage admin page with message

?>