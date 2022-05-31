<table class="table table-bordered table-hover">
    <thead><tr>
    <th>ID</th>
    <th>Author</th>
    <th>Comment</th>
    <th>Email</th>
    <th>Status</th>
    <th>Commented On</th>
    <th>Date</th>
    <th>Approve</th>
    <th>Decline</th>
    <th>Delete</th>
    </tr></thead>
    <tbody>
        <?php 
            $query = "SELECT * FROM comments ORDER BY comment_id DESC";
            $select_comments = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($select_comments)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                echo "<tr>";
                echo "<td>{$comment_id}</td>"; 
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";

                $query = "select * from posts where post_id = $comment_post_id ";
                $select_post_title = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_post_title)) {
                    $post_id = $row['post_id'];
                    $the_post_title = $row['post_title'];

                    echo "<td><a href='../post.php?p_id={$post_id}'>{$the_post_title}</a></td>";
                }

                echo "<td>{$comment_date}</td>";
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</td>";
                echo "<td><a href='comments.php?decline={$comment_id}'>Decline</td>";
                echo "<td><a href='comments.php?delete={$comment_id}'>Delete</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    if(isset($_GET['delete'])){
        $del_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = $del_comment_id";

        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if(isset($_GET['approve'])){
        $approve_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_id";

        $approve_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if(isset($_GET['decline'])){
        $decline_comment_id = $_GET['decline'];
        $query = "UPDATE comments SET comment_status = 'Declined' WHERE comment_id = $decline_comment_id";

        $decline_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    }
?>