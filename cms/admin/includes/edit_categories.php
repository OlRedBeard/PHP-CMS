<form action="" method="post"> <!-- Copied form for update -->
    <div class="form-group">
        <label for="cat_title">Update Category</label>
        <?php 
            if(isset($_GET['update'])){
                $cat_id = $_GET['update'];
                $query = "SELECT * FROM categories WHERE Cat_ID = $cat_id";
                $select_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['Cat_ID'];
                    $cat_title = $row['Cat_Title'];
        ?>
            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
        <?php
            }}
        ?>
        <?php 
            if(isset($_POST['update_category'])) {
                $up_cat_title = $_POST['cat_title'];
                $up_cat_id = $_GET['update'];
                $query = "UPDATE Categories SET Cat_Title = '{$up_cat_title}' WHERE Cat_ID = {$up_cat_id}";
                $update_query = mysqli_query($connection, $query);
                if(!$update_query){
                    die("Query failed" . mysqli_error($connection));
                }
                //header("Location: categories.php"); // Refreshes page
            }
        ?>
        
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>