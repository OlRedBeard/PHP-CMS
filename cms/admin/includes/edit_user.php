<?php 
    if(isset($_GET['u_id'])) {
        $user_id = $_GET['u_id'];
    }

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

    if(isset($_POST['update_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = {$user_id}";
            $select_image_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image_query)){
                $user_image = $row['user_image'];
            }
        }

        $query = "UPDATE users SET username = '{$username}', password = '{$password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}'";

        $update_user_query = mysqli_query($connection, $query);

        confirm_query($update_user_query);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input value="<?php echo $password ?>" type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email ?>" type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_image">User Image (200px x 200px)</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label><br/>
        <select name="user_role" id="user_role">
            <option value='user'>Select Role</option>
            <option value='admin' <?php if($user_role == 'admin') echo " selected='selected'" ?>>Admin</option>
            <option value='user' <?php if($user_role == 'user') echo " selected='selected'" ?>>User</option>
        </select>
    </div>
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>