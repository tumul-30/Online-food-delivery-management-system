<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
                <?php
                    //display all the category that are active
                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {//it will get all the details from the databse in our row
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name == "")
                                    {
                                        echo "<div style= 'color:red;'><b>Image not Available</b></div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?> " alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                        <?php
                        }
                    }
                    else
                    {
                        echo "<div style= 'color:red;'><b>No categories Found</b></div>";
                    }
                ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>