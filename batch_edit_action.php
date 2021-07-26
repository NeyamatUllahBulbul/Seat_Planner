<?php
session_start();
if ($_POST) {
    $batch_id   = $_POST['batch_id'];
    $name       = $_POST['name'];
    $details    = $_POST['details'];
    $dept       = $_POST['dept'];
    $co         = $_POST['co'];
    $status     = $_POST['status'];


    if ($name == '') {
        $_SESSION['error'] = 'Batch name cannot be empty<br>';
        header('location:batch_edit.php?bid='.$batch_id);
        exit;
    }
    if ($details == '') {
        $_SESSION['error'] = 'Batch details cannot be empty<br>';
        header('location:batch_edit.php?bid='.$batch_id);
        exit;
    }
    if ($dept == '') {
        $_SESSION['error'] = 'Department name cannot be empty<br>';
        header('location:batch_edit.php?bid='.$batch_id);
        exit;
    }
    if ($co == '') {
        $_SESSION['error'] = 'Department slug cannot be empty<br>';
        header('location:batch_edit.php?bid='.$batch_id);
        exit;
    }

    include_once 'database_connection.php';
    $conn = connect();

    $sql="UPDATE batches SET name='$name', details='$details', dept_id='$dept', co_ordinator='$co', status='$status' WHERE id= '$batch_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Batch information updated successfully';
    header('location:batch_edit.php?bid='.$batch_id);

}
?>


