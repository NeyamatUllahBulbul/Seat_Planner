<?php
    if (isset($_POST)){
        $routine_id = $_POST['routine_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM exam_routine WHERE id= '$routine_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Routine deleted successfully';
    header('location:exam_routine_index.php');
?>