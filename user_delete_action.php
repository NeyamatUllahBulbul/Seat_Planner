<?php
    if (isset($_POST)){
        $user_id = $_POST['user_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM users WHERE id= '$user_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'User deleted successfully';
    header('location:user_index.php');
?>
