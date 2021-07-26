<?php
    if (isset($_POST)){
        $batch_id = $_POST['batch_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM batches WHERE id= '$batch_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Batch deleted successfully';
    header('location:batch_index.php');
?>
