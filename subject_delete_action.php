<?php
    if (isset($_POST)){
        $subject_id = $_POST['subject_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM subjects WHERE id= '$subject_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Subject deleted successfully';
    header('location:subject_index.php');
?>