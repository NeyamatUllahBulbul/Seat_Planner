<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])){
    header('location:admin.php');
    exit;
}
?>
<?php include_once 'template/_head.php'?>

<body>

<!-- Left Panel -->
<?php include_once 'template/leftNav.php'?>
<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php include_once 'template/header.php'?>
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Batch management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <a href="student_create.php" class="btn btn-sm btn-warning">Add New</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'database_connection.php';
    $conn = connect();
    $sql = "SELECT students.*, batches.name as Bname
            FROM students
            INNER JOIN batches ON students.batch_id=batches.id";
    $students= $conn->query($sql);
    $serial = 1;
    ?>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All batches</strong>
                    </div>
                    <div class="card-body text-center">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 3px;">Sl</th>
                                <th>Name</th>
                                <th>Guardian's name</th>
                                <th>Contact no</th>
                                <th>Date of birth</th>
                                <th>Student ID</th>
                                <th>Student email</th>
                                <th>Batch</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($students as $student){
                                ?>
                                <tr>
                                    <td><?= $serial++?></td>
                                    <td><?= $student['name']?></td>
                                    <td><?= $student['guardian_name']?></td>
                                    <td><?= $student['phone']?></td>
                                    <td><?= $student['date_of_birth']?></td>
                                    <td><?= $student['student_id']?></td>
                                    <td><?= $student['student_email']?></td>
                                    <td><?= $student['Bname']?></td>
                                    <td><?= $student['status']?></td>
                                    <td>
                                        <a  href="student_edit.php?sid=<?= $student['id']?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-edit"></i>Edit
                                        </a>
                                        <form class="" action="student_delete_action.php" method="post" style="display:inline">
                                            <input type="hidden" name="student_id" value="<?= $student['id']?>">
                                            <button title="Delete" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--/.col-->


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<?php include_once 'template/footer.php'?>


