<?php
session_start();
if ($_POST) {
    $dept_id    = $_POST['dept_id'];
    $name       = $_POST['name'];
    $details    = $_POST['details'];
    $head       = $_POST['head'];
    $slug       = $_POST['slug'];
    $status     = $_POST['status'];


    if ($name == '') {
        $_SESSION['error'] = 'Department name cannot be empty<br>';
        header('location:department_edit.php');
        exit;
    }
    if ($details == '') {
        $_SESSION['error'] = 'Department details cannot be empty<br>';
        header('location:department_edit.php');
        exit;
    }
    if ($head == '') {
        $_SESSION['error'] = 'Department head name cannot be empty<br>';
        header('location:department_edit.php');
        exit;
    }
    if ($slug == '') {
        $_SESSION['error'] = 'Department slug cannot be empty<br>';
        header('location:department_edit.php');
        exit;
    }

    include_once 'database_connection.php';
    $conn = connect();

    $sql="UPDATE departments SET name='$name', details='$details', head='$head', slug='$slug', status='$status' WHERE id= '$dept_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Department updated successfully';
    header('location:department_edit.php?did='.$dept_id);

}
?>

