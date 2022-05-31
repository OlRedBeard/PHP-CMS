<?php 
    include "includes/header.php";
    include "includes/navigation.php";
?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ORDER BY post_id DESC";
                        $search_query = mysqli_query($connection, $query);
    
                        if(!$search_query) {
                            die("Query Failed" . mysqli_error($connection));
                        }
    
                        $count = mysqli_num_rows($search_query);
    
                        if ($count == 0) {
                            echo "<h1 class='text-center'>No Posts Found</h1>";
                        }
                    }
                    else {
                        $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC";
                        $select_all_posts_query = mysqli_query($connection, $query);

                        $count = mysqli_num_rows($select_all_posts_query);

                        if ($count == 0) {
                            echo"<h1 class='text-center'>No Posts Found</h1>";
                        }
                        else {

                        while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,100 ) . "..."; 
                            $post_status = $row['post_status'];

                            if($post_status != 'Published'){
                                //echo "<h1 class='text-center'>No Posts Available</h1>";
                            }
                    ?>
                        <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>    
                            <hr>
                        <?php }}} ?>
                    
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
                
            </div>
        </div>
        <!-- /.row -->
        <hr>
<?php 
    include "includes/footer.php";
?>
