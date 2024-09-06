<?php
include('partials/menu.php');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br><br>

        <?php

        if(isset($_GET['id'])){
            //get the id
            $id =$_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id = $id";

            $res = mysqli_query($conn,$sql);

            $count= mysqli_num_rows($res);

            if($count==1){
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                $_SESSION['no-category']="<div style= 'color:red;'><b>Category not Found</b></div>";
                header('location:'.SITEURL.'admin/manage-categories.php');
            }
        }
        else{
            header('location:'.SITEURL.'admin/manage-categories.php');
        }

        ?>

<form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" placeholder="enter the title" value="<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                    if($current_image != "")
                    {
                        ?>

                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width = "100px">

                        <?php
                    }
                    else{
                        echo "<div style= 'color:red;'>Image Not Added</div>";
                    }
                    ?>
                </td>
            </tr>
           
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                    <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
                <input <?php if($active=="no"){echo "checked";}?>type="radio" name="active" value="no">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="cuurent_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="update category" class="btn-secondary">
                </td>
            </tr>
        </table>
</form>

<?php

        if(isset($_POST['submit']))
        {
            //get all the values
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

           
            //update the database
            $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
            ";

            $res2 = mysqli_query($conn, $sql2);
            //redirect to manage category

            if($res2 == true){
                $_SESSION['category-update'] = "<div style= 'color:#009432;'><b>Category Updated Successfully</b></div>";
                header('location:'.SITEURL.'admin/manage-categories.php');
            }
            else{
                $_SESSION['category-update']= "<div style= 'color:red;'><b>failed to update category</b></div>";
                 header('location:'.SITEURL.'admin/manage-categories.php');
            }
        }


?>
    </div>
</div>

<?php include('partials/footer.php');
?>

