<?php
session_start();
if ($_POST){
    $name       = $_POST['name'];
    $details    = $_POST['details'];
    $head       = $_POST['head'];
    $status     = $_POST['status'];
    $slug       = $_POST['slug'];
    if ($status == ''){
        $status = 'Active';
    }

    if($name == ''){
        $_SESSION['error']= 'Please insert your name<br>';
        header('location:department_create.php');
        exit;
    }
    if($head == ''){
        $_SESSION['error']= 'Please insert the name of the head of department<br>';
        header('location:department_create.php');
        exit;
    }
    if($slug == ''){
        $_SESSION['error']= 'Please insert a slug for the department<br>';
        header('location:department_create.php');
        exit;
    }elseif (strlen($slug) > 5){
        $_SESSION['error']= 'Slug cannot be more then 5 characters<br>';
        header('location:department_create.php');
        exit;
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql = "SELECT * FROM departments WHERE name = '$name' OR slug = '$slug'";
    $output= $conn->query($sql);

    if ($output->num_rows > 0){
        $_SESSION['error']= 'Department name already exists';
        header('location:department_create.php');
        exit;
    } else {
        $sql="INSERT INTO departments (name,details,head,slug,status)
				VALUES ('$name','$details','$head','$slug','$status')";
        $conn->query($sql);
        $_SESSION['success']= 'Department created successfully';
        header('location:department_create.php');
    }

}

?>

