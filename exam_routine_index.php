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
                    <h1>Exam Routine management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <a href="add_exam_routine.php" class="btn btn-sm btn-warning">Add New</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT b.name as batch, s.name as semister, e.id, e.photo FROM exam_routine as e
                INNER JOIN batches as b
                ON b.id = e.batch_id
                INNER JOIN semesters as s 
                ON s.id = e.semister_id";
        $routines= $conn->query($sql);
        $serial = 1;
    ?>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Routines</strong>
                    </div>
                    <div class="card-body text-center">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 3px;">Sl</th>
                                <th>Batch Name</th>
                                <th>Semister Name</th>
                                <th>Routine Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($routines as $routine){
                                ?>
                                <tr>
                                    <td><?= $serial++?></td>
                                    <td><?= $routine['batch']?></td>
                                    <td><?= $routine['semister']?></td>
                                    <td><img src="<?= $routine['photo']?>" alt="" style='width: 50px; height: 50px;'></td>
                                    <td>
                                        <form class="" action="routine_delete_action.php" method="post" style="display:inline">
                                            <input type="hidden" name="routine_id" value="<?= $routine['id']?>">
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

