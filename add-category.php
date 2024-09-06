<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>
<?php
        if(isset($_SESSION['category'])){
            echo $_SESSION['category'];//displaying session message
            unset($_SESSION['category']);//removing session message
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing session message
        }
?>
        <!-- category form starts -->
        <form action="" method="POST" enctype = "multipart/form-data"><!-- enctype allows us to upload a file -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category"  class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

         <!-- category form ends -->

         <?php  
            //1.check whether the submit button is clicked or not
            
            if(isset($_POST['submit'])){
    
                //get the value from the  category form
                $title = $_POST['title'];
                if(isset($_POST['featured']))//for radio button type getting value like this
                {
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }
                if(isset($_POST['active']))//for radio button type getting value like this
                {
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }
                //check whther the image is sselected or not
                //print_r($_FILES['image']);print_r is use dto display the value of array
                //die();

                if(isset($_FILES['image']['name'])){
                    //upload the image
                    $image_name=$_FILES['image']['name'];//image name
                if($image_name != "")
                {

                    
                    //auto rename our image
                    //get the extension of our image(jpg,gif,png)
                    $ext = end(explode('.',$image_name));//getting the extension

                    $image_name = "Food_category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];//getting source path
                    $dest_path = "../images/category/".$image_name;
                    $upload = move_uploaded_file($source_path, $dest_path);//uploading image to category folder

                    //check if the image is uploaded or not
                    if($upload == false){
                        $_SESSION['upload']= "<div style= 'color:red;'><b>failed to upload image</b></div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();//stop the processing
                    }
                }
                }
                else{
                    //dont upload the image and set the image_name value to blank
                    $image_name="";
                }

                $sql = "INSERT INTO tbl_category SET
                            title = '$title',
                            image_name='$image_name',
                            featured = '$featured',
                            active = '$active'
                            ";

                $res = mysqli_query($conn ,$sql);

                if($res == true){
                    $_SESSION['category'] = "<div style= 'color:#009432;'><b>Category Added Successfully</b></div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
                else{
                    $_SESSION['category']= "<div style= 'color:red;'><b>failed to add Category</b></div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
         ?>
    </div>
</div>


<?php include('partials/footer.php') ?>
