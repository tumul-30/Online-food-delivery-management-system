<?php include('partials/menu.php'); ?>

 <!-- main section starts -->
 <div class="main-content">
        <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>
        <?php
             if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session message
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];//displaying session message
                unset($_SESSION['remove']);//removing session message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//displaying session message
                unset($_SESSION['delete']);//removing session message
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//displaying session message
                unset($_SESSION['upload']);//removing session message
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//displaying session message
                unset($_SESSION['update']);//removing session message
            }
          
        ?>
        <br>
        <br>

        


        <!-- button to add admin-->
        <a href="<?php echo SITEURL?>admin/add-food.php" class="btn-primary">Add Food</a><br><br><br>
        

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Ttile</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            $sn = 1;

            if($count > 0)
            {
                //get the food from database
                while($row = mysqli_fetch_assoc($res))
                {
                  $id = $row['id']; 
                  $title = $row['title'];  
                  $price = $row['price'];  
                  $image_name = $row['image_name'];  
                  $featured = $row['featured'];  
                  $active = $row['active']; 
                  ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $price; ?></td>
                <td>
                    
                    <?php 
                        if($image_name =="")
                        {
                           echo  "<div style= 'color:red;'><b>Image not Added</b></div>";
                        }
                        else
                        {
                            ?>

                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" width="100px">
                            <?php
                        }
                    ?>
            
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td><a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                </td>
            </tr>
                  <?php
                }
            }
            else
            {
                echo "<tr><td colspan = '7' style= 'color:red;'>Food Not Added YET</td></tr>";
            }

            ?>
          
            
        </table>
       
        </div>
    </div>
    <!-- main section ends -->

<?php include('partials/footer.php'); ?>