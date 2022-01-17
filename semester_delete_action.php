<?php
    if (isset($_POST)){
        $semester_id = $_POST['semester_id'];
    }
    include_once 'database_connection.php';
    $conn = connect();

    $sql="DELETE FROM semesters WHERE id= '$semester_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Semester deleted successfully';
    header('location:semester_index.php');
?>
