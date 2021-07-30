<?php
    if (isset($_POST)){
        $student_id = $_POST['student_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM students WHERE id= '$student_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Student deleted successfully';
    header('location:student_index.php');
?>
