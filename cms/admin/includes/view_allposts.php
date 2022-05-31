<table class="table table-bordered table-hover">
    <thead><tr>
    <th>ID</th>
    <th>Author</th>
    <th>Title</th>
    <th>Category</th>
    <th>Status</th>
    <th>Image</th>
    <th>Tags</th>
    <th>Comments</th>
    <th>Date</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr></thead>
    <tbody>
        <?php 
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($select_posts)) {
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
                echo "<tr>";
                echo "<td>{$post_id}</td>"; 
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories WHERE Cat_ID = $post_cat_id";
                $select_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['Cat_ID'];
                    $cat_title = $row['Cat_Title'];
                }

                echo "<td>{$cat_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/$post_image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comments}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    if(isset($_GET['delete'])){
        $del_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = $del_post_id";

        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
?>