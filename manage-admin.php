<?php include('<partials/menu.php'); ?>


     <!-- main section starts -->
     <div class="main-content">
        <div class="wrapper">
        <h1>Manage Admin</h1><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session message
        } 
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];//displaying session message
            unset($_SESSION['delete']);//removing session message
        } 

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];//displaying session message
            unset($_SESSION['update']);//removing session message
        }
        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];//displaying session message
            unset($_SESSION['user-not-found']);//removing session message
        }
        if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];//displaying session message
            unset($_SESSION['pwd-not-match']);//removing session message
        }
        if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];//displaying session message
            unset($_SESSION['change-pwd']);//removing session message
        }
        ?>

        <br><br><br>


        <!-- button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br><br>
        

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full name</th>
                <th>UserName</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_admin";
            //execute the qeury
            $res = mysqli_query($conn, $sql);
            if($res == TRUE){
                //count rows
                $count = mysqli_num_rows($res);//get all the rows in database
                $sn=1;

                if($count > 0){
                    while($rows = mysqli_fetch_assoc($res))
                    {
                        $id = $rows['id'];
                        $full_name =$rows['full_name'];
                        $username = $rows['user_name'];

                        //display the values
                        ?>

        <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Password</a>
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
                        <?php
                    }
                }
            }
             ?>
        </table>
       
        </div>
    </div>
    <!-- main section ends -->

<?php include('partials/footer.php'); ?>