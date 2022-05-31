<?php 
    if(isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }

    if(isset($_POST['update_post'])){
        $post_title = mysqli_real_escape_string($connection, $_POST['title']);
        $post_author = mysqli_real_escape_string($connection, $_POST['author']);
        $post_cat_id = $_POST['post_cat_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
            $select_image_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image_query)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_category_id = {$post_cat_id}, post_title = '{$post_title}', post_author = '{$post_author}', ";
        $query .= "post_date = now(), post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' WHERE post_id = {$post_id}";

        $update_post_query = mysqli_query($connection, $query);

        confirm_query($update_post_query);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title" >
    </div>
    <div class="form-group">
        <label for="cat_title">Edit Category: </label><br/>
        <select name="post_cat_id" id="post_cat_id">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                confirm_query($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['Cat_ID'];
                    $cat_title = $row['Cat_Title'];

                    echo "<option value='{$cat_id}'";

                    if($post_cat_id == $cat_id) {
                        echo " selected='selected'";
                    } 
                    echo ">{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Current Image</label>
        <img src="../images/<?php echo $post_image ?>" alt="" width="100">
    </div>
    <div class="form-group">
        <label for="post_image">Update Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>