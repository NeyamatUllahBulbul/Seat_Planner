<?php
session_start();
if ($_POST) {
    $name       = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];
    $status     = $_POST['status'];
    if ($status == '') {
        $status = 'Active';
    }

    if ($name == '') {
        $_SESSION['error'] = 'Please insert semester name<br>';
        header('location:semester_create.php');
        exit;
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql    = "SELECT * FROM semester WHERE name = '$name'";
    $output = $conn->query($sql);

    if ($output->num_rows > 0) {
        $_SESSION['error'] = 'Semester name already exists';
        header('location:semester_create.php');
        exit;
    } else {
        $sql = "INSERT INTO semesters (name,start_date,end_date,status)
				VALUES ('$name','$start_date','$end_date','$status')";
        $conn->query($sql);
        $_SESSION['success'] = 'Semester created successfully';
        header('location:semester_index.php');
    }
}
?>


