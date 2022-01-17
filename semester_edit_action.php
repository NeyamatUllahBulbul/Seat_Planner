<?php
session_start();
if ($_POST) {
    $semester_id   = $_POST['semester_id'];
    $name       = $_POST['name'];
    $start_date    = $_POST['start_date'];
    $end_date      = $_POST['end_date'];
    $status     = $_POST['status'];


    if ($name == '') {
        $_SESSION['error'] = 'Semester name cannot be empty<br>';
        header('location:semester_edit.php?sid='.$semester_id);
        exit;
    }

    include_once 'database_connection.php';
    $conn = connect();

    $sql="UPDATE semesters SET name='$name', start_date='$start_date', end_date='$end_date', status='$status' WHERE id= '$semester_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Semester information updated successfully';
    header('location:semester_edit.php?sid='.$semester_id);

}
?>


