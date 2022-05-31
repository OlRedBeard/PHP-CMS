<?php 
    include "db.php"; 
    session_start();

    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $user_login_query = mysqli_query($connection, $query);

        if(!$user_login_query){
            die ("Query Failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_array($user_login_query)){
            $db_id = $row['user_id'];
            $db_username = $row['username'];
            $db_password = $row['password'];
            $db_firstname = $row['user_firstname'];
            $db_lastname = $row['user_lastname'];
            $db_userrole = $row['user_role'];
        }

        if($username === $db_username && $password === $db_password){
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['user_role'] = $db_userrole;

            header("Location: ../admin");
        }
        else {
            header("Location: ../index.php");
        }
    }
?>