<?php
    session_start();
    if($_POST){
        $email 	  = $_POST['email'];
        $pass     = $_POST['password'];
        $password = md5($pass);

        if(!isset($_SESSION['count'])){
            $_SESSION['count'] = 0;
        }

        if($email == ''){
            $_SESSION['error']= 'Please insert your email.<br>';
            header('location:admin.php');
            exit;
        }

        if($password == ''){
            $_SESSION['error']= 'Please insert your password.<br>';
            header('location:admin.php');
            exit;
        }

        include_once 'database_connection.php';
        $conn = connect();

        $sql = "SELECT * FROM users WHERE email= '$email' AND password= '$password' AND status='Active' 
                OR  username= '$email' AND password= '$password' AND status='Active'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            foreach($result AS $row){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_id'] = $row['id'];
            }
            $_SESSION['loggedin'] = true;
            unset($_SESSION['count']);

            header('location:dashboard.php');
        }else{
            $_SESSION['count']++;
            if($_SESSION['count'] >= 3){
                setcookie('loginCounter', true, time() + (60*1));
                $_SESSION['count'] = 0;
            }
            $_SESSION['error']= 'Invalid login!<br>';
            header('location:admin.php');
        }
    }
?>
