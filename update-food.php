<?php include('partials/menu.php');?>

<?php
        //check whether id is set or not
        if(isset($_GET['id']))
        {
            //get all details
            $id = $_GET['id'];

            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($res2);//get all the values of selected food in array

            //get individual values of selected food
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-food.php');
        }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value ="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description"  cols="30" rows="10"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php

                            if($current_image =="")
                            {
                                echo "<div style= 'color:red;'><b>No image Added</b></div>";
                            }
                            else
                            {
                                ?>

                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width = "100px"> 
                                <?php

                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td><select name="category">


                    <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        
                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                            <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                        
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>Category Not available</option>";
                                }

                            ?>

                        
                    </select></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td><input <?php if($featured == "yes"){echo "checked";} ?> type="radio" name="featured" value="yes">Yes
                    <input <?php if($featured == "no"){echo "checked";} ?> type="radio" name="featured" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td><input <?php if($active == 'yes'){echo "checked";} ?> type="radio" name="active" value="yes">Yes
                    <input <?php if($active == 'no'){echo "checked";} ?> type="radio" name = "active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="update food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));

                        $image_name = "Food-name-".rand(000,999).'.'.$ext;

                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div style= 'color:red;'><b>failed to upload new image</b></div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                        if($current_image != "")
                        {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove == false)
                            {
                               $_SESSION['remove-failed'] = "<div style= 'color:red;'><b>failed to remove current image</b></div>";
                               header('location:'.SITEURL.'admin/manage-food.php');
                               die();
                            }
                        }


                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description ='$description',
                        price = $price,
                        category_id = '$category',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id";

                        $res3 = mysqli_query($conn, $sql3);

                        if($res3==true)
                        {
                            $_SESSION['update']= "<div style= 'color:#009432;'><b>Food updated successfully</b></div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {
                            $_SESSION['update']= "<div style= 'color:red;'><b>failed to update food</b></div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>