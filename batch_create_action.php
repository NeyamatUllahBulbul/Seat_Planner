<?php
session_start();
if ($_POST){
    $name       = $_POST['name'];
    $details    = $_POST['details'];
    $dept       = $_POST['dept'];
    $co         = $_POST['co'];
    $status     = $_POST['status'];
    if ($status == ''){
        $status = 'Active';
    }

    if($name == ''){
        $_SESSION['error']= 'Please insert your name<br>';
        header('location:batch_create.php');
        exit;
    }
    if($dept == ''){
        $_SESSION['error']= 'Please select a department<br>';
        header('location:batch_create.php');
        exit;
    }
    if($co == ''){
        $_SESSION['error']= 'Please insert batch co-ordinator name<br>';
        header('location:batch_create.php');
        exit;
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql = "SELECT * FROM batches WHERE name = '$name'";
    $output= $conn->query($sql);

    if ($output->num_rows > 0){
        $_SESSION['error']= 'Batch name already exists';
        header('location:batch_create.php');
        exit;
    } else {
        $sql="INSERT INTO batches (name,details,dept_id,co_ordinator,status)
				VALUES ('$name','$details','$dept','$co','$status')";
        $conn->query($sql);
        $_SESSION['success']= 'Batch created successfully';
        header('location:batch_create.php');
    }

}
?>


