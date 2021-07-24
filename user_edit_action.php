<?php
    session_start();
    if ($_POST) {
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $status = $_POST['status'];


        if ($name == '') {
            $_SESSION['error'] = 'Please insert your name<br>';
            header('location:user_edit.php');
            exit;
        }
        if ($username == '') {
            $_SESSION['error'] = 'Please insert your name<br>';
            header('location:user_edit.php');
            exit;
        }
        if ($email == '') {
            $_SESSION['error'] = 'Please insert your name<br>';
            header('location:user_edit.php');
            exit;
        }
        if ($status == '') {
            $_SESSION['error'] = 'Please select status first<br>';
            header('location:user_edit.php');
            exit;
        }

        include_once 'database_connection.php';
        $conn = connect();

        $sql="UPDATE users SET name='$name', username='$username', email='$email', status='$status' WHERE id= '$user_id' ";
        $conn->query($sql);
        $_SESSION['success']= 'User updated successfully';
        header('location:user_edit.php?uid='.$user_id);

    }
?>
