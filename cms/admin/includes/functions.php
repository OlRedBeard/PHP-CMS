<?php 

function confirm_query($query) {
    global $connection;

    if (!$query) {
        die("Query Failed " . mysqli_error($connection));
    }
}

function insert_categories() {
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "Title Cannot be Blank";
        } 
        else {
            $query = "INSERT INTO categories(Cat_Title) VALUE('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){
                die("Failed to Add Category" . mysqli_error()); 
            }
        }
    }
}

function delete_categories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE Cat_ID = {$del_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php"); // Refreshes page
    }
}

function list_categories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['Cat_ID'];
        $cat_title = $row['Cat_Title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td><td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Update</td>";
        echo "</tr>";
    }
}
?>