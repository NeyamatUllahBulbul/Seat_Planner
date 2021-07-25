<?php
    if (isset($_POST)){
        $dept_id = $_POST['dept_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM departments WHERE id= '$dept_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Department deleted successfully';
    header('location:department_index.php');
?>
