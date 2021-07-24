<?php
    session_start();
    if ($_POST){
        $name       = $_POST['name'];
        $username   = $_POST['username'];
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $status     = $_POST['status'];
        if ($status == ''){
            $status = 'Active';
        }

        if($name == ''){
            $_SESSION['error']= 'Please insert your name<br>';
            header('location:user_create.php');
            exit;
        }
        if($username == ''){
            $_SESSION['error']= 'Please insert your name<br>';
            header('location:user_create.php');
            exit;
        }
        if($email == ''){
            $_SESSION['error']= 'Please insert your name<br>';
            header('location:user_create.php');
            exit;
        }
        if($password == ''){
            $_SESSION['error']= 'Please insert your name<br>';
            header('location:user_create.php');
            exit;
        } elseif (strlen($password) > 16 || strlen($password) < 8){
            $_SESSION['error']= 'Your password must be 8-16 characters';
            header('location:user_create.php');
            exit;
        } elseif (!preg_match("#[0-9]+#",$password) && !preg_match("#[A-Z]#",$password)){
            $_SESSION['error']= 'Your password must contain at least one number and capital letter';
            header('location:user_create.php');
            exit;
        }
        include_once 'database_connection.php';
        $conn = connect();

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $output= $conn->query($sql);

        if ($output->num_rows > 0){
            $_SESSION['error']= 'Username already exists';
            header('location:user_create.php');
            exit;
        } else {
            $pass = md5($password);
            $sql="INSERT INTO users (name,username,email,password,status)
				VALUES ('$name','$username','$email','$pass','$status')";
            $conn->query($sql);
            $_SESSION['success']= 'User created successfully';
            header('location:user_create.php');
        }

    }

?>
