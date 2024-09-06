<?php include('partials/menu.php'); ?>

 <!-- main section starts -->
 <div class="main-content">
        <div class="wrapper">
        <h1>Manage Categories</h1>
        <br><br>
<?php
        if(isset($_SESSION['category'])){
            echo $_SESSION['category'];//displaying session message
            unset($_SESSION['category']);//removing session message
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];//displaying session message
            unset($_SESSION['remove']);//removing session message
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];//displaying session message
            unset($_SESSION['delete']);//removing session message
        }
        if(isset($_SESSION['no-category'])){
            echo $_SESSION['no-category'];//displaying session message
            unset($_SESSION['no-category']);//removing session message
        }
        if(isset($_SESSION['category-update'])){
            echo $_SESSION['category-update'];//displaying session message
            unset($_SESSION['category-update']);//removing session message
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing session message
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];//displaying session message
            unset($_SESSION['failed-remove']);//removing session message
        }
?>

<br><br>
<!-- button to add admin-->
<a href="add-category.php" class="btn-primary">Add Categories</a><br><br><br>


<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql = "SELECT * FROM tbl_category";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);//count the  umber of rows
    $sn=1;

    if($count > 0 ){
        //we have data in our database
        while($row=mysqli_fetch_assoc($res)){//get the data from database
            $id =$row['id'];
            $title = $row['title'];
            $image_name=$row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>
     <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $title; ?></td>

        <td>
            <?php
             //check whether image is available or not
             if($image_name!=""){
                ?>

                <img src="<?php  echo SITEURL; ?>images/category/<?php  echo $image_name;?>" width= "100px">

                <?php
             }
             else{
                echo "<div style= 'color:red;'><b>No Image Added</b></div>";
             }
            ?>
        </td>

        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td><a href="<?php echo SITEURL?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
        </td>
    </tr>
            <?php
        }
    }
    else{
        ?>
        <tr colspan="6"><td><div style= 'color:red;'><b>No Category Added</b></div></td></tr>
        <?php
    }
    ?>
   
    
</table>
        </div>
    </div>
    <!-- main section ends -->

<?php include('partials/footer.php'); ?>

