<table class="table table-bordered table-hover">
    <thead><tr>
    <th>ID</th>
    <th>Username</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Image</th>
    <th>Role</th>
    <th>Make Admin</th>
    <th>Edit User</th>
    <th>Delete</th>
    </tr></thead>
    <tbody>
        <?php 
            $query = "SELECT * FROM users ORDER BY username";
            $select_users = mysqli_query($connection, $query);
        
            while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                echo "<tr>";
                echo "<td>{$user_id}</td>"; 
                echo "<td>{$username}</td>"; 
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td><img width='100' src='../images/$user_image'></td>";
                echo "<td>{$user_role}</td>";
                echo "<td><a href='users.php?make_admin={$user_id}'>Make Admin</td>";
                echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</td>";
                echo "<td><a href='users.php?delete={$user_id}'>Delete</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    if(isset($_GET['delete'])){
        $del_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $del_user_id";

        $delete_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }

    if(isset($_GET['make_admin'])){
        $admin_id = $_GET['make_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$admin_id}'";

        $admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
?>