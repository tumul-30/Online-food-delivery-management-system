<?php 
include('../config/const.php');
//check whether the id and image value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available
        if($image_name!= ""){
            $path = "../images/food/".$image_name;
            $remove = unlink($path);//unlink function will remove the image

            if($remove == false){
                $_SESSION['remove']= "<div style= 'color:red;'><b>Failed to remove category image</b></div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }

        }

        //delete data from database
        $sql = "DELETE FROM tbl_food WHERE id = $id";

        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete']= "<div style= 'color:#009432;'><b>Category deleted successfully</b></div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete']= "<div style= 'color:red;'><b>failed to delete category</b></div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
}
else{
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>