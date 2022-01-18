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
                    <h1>Batch Subjects management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <a href="assign_subjects.php" class="btn btn-sm btn-warning">Assign Subjects</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT b.name as batch_name, b.id, s.name as semester_name, sub.name as subjects  FROM assigned_batch_subjects as ab
                INNER JOIN batches as b ON b.id = ab.batch_id
                INNER JOIN semesters as s ON s.id = ab.semister_id
                INNER JOIN subjects as sub ON sub.id = ab.subjects_id";
        $subjects= $conn->query($sql);
        $serial = 1;
    ?>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Assigend</strong>
                    </div>
                    <div class="card-body text-center">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 3px;">Sl</th>
                                <th>Batch Name</th>
                                <th>Semister Name</th>
                                <th>Subject Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($subjects as $subject){
                                ?>
                                <tr>
                                    <td><?= $serial++?></td>
                                    <td><?= $subject['batch_name']?></td>
                                    <td><?= $subject['semester_name']?></td>
                                    <td><?= $subject['subjects']?></td>
                                    <td>
                                        <form class="" action="#" method="post" style="display:inline">
                                            <input type="hidden" name="batch_id" value="<?= $subject['id']?>">
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

