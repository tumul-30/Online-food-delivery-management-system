<?php include('../config/const.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page-Food Order delivery</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="body">
    <div class="login">
        <h1 class="text-center">LOGIN</h1><br>

        <?php
         if(isset($_SESSION['login'])){
            echo $_SESSION['login'];//displaying session message
            unset($_SESSION['login']);//removing session message
        } 

        if(isset($_SESSION['no-login'])){
            echo $_SESSION['no-login'];//displaying session message
            unset($_SESSION['no-login']);//removing session message
        } 
        ?>
        <!--LOGIN FORM SATRTS HERE  -->

        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="enter username"><br><br>
            Password:
            <input type="password" name="password" placeholder="enter password"><br><br>

            <input type="submit" name="submit" value="login" class="btn-secondary" ><br><br>
        </form>


        <!--LOGIN FORM ENDS HERE  -->
        <p class="text-center">Created By - <a href="www.dishamishra.com">Disha Mishra</a> </p>
    </div>
</body>
</html>

<?php
//check whther submit button is clicked or not
if(isset($_POST['submit'])){
    //1.get the data from login form
     $username = $_POST['username'];
     $password =md5($_POST['password']);

     //sql query to check whether the user with usernam and password exits or not
     $sql = "SELECT * FROM tbl_admin WHERE user_name ='$username' AND password='$password'";

     $res=mysqli_query($conn,$sql);
    if($res == true){
     $count = mysqli_num_rows($res);
     if($count == 1){
        $_SESSION['login'] = "<div style= 'color:#009432;'><b>LOGIN SUCCESSFULL</b></div>";
        $_SESSION['user']=$username;//to check wehther user is logged in or not
        header('location:'.SITEURL.'admin/');
     }
     else{
        $_SESSION['login'] = "<div style= 'color:red;' class='text-center'><b>LOGIN FAILED</b></div>";
        header('location:'.SITEURL.'admin/login.php');
     }
    }
}
?>