<?php
    if (isset($_POST)){
        $batch_id = $_POST['batch_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM assigned_batch_subjects WHERE batch_id= '$batch_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Subjects deleted successfully';
    header('location:assign_subjects_index.php');
?>