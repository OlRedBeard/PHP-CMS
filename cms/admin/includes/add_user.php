<?php 
    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images/{$user_image}");

        $query = "INSERT INTO users (username, password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES('{$username}','{$password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}')";

        $create_post_query = mysqli_query($connection, $query);

        confirm_query($create_post_query);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_image">User Image (200px x 200px)</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label><br/>
        <select name="user_role" id="user_role">
            <option value='user'>Select Role</option>
            <option value='admin'>Admin</option>
            <option value='user'>User</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>