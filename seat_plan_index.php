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
                    <h1>Seat plan management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <a href="create_seat_plan.php" class="btn btn-sm btn-warning">Add New</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'database_connection.php';
    $conn = connect();
    $sql = "SELECT * from seat_plans";
    $seat_plans= $conn->query($sql);
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
                                <th>First batch</th>
                                <th>First batch subject</th>
                                <th>Second batch</th>
                                <th>Second batch subject</th>
                                <th>Exam name</th>
                                <th>Exam date</th>
                                <th>Exam time</th>
                                <th>Room number</th>
                                <th>Seat</th>
                                <th>Number of column</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($seat_plans as $plan){
                                ?>
                                <tr>
                                    <td><?= $serial++?></td>
                                    <td><?= $plan['first_batch']?></td>
                                    <td><?= $plan['first_subject']?></td>
                                    <td><?= $plan['second_batch']?></td>
                                    <td><?= $plan['second_subject']?></td>
                                    <td><?= $plan['exam_name']?></td>
                                    <td><?= date('d/m/Y',strtotime($plan['date']))?></td>
                                    <td><?= date('h:i A',strtotime($plan['time']))?></td>
                                    <td><?= $plan['room_no']?></td>
                                    <td><?= $plan['seat']?></td>
                                    <td><?= $plan['column_number']?></td>
                                    <td>
                                        <form class="" action="seat_plan_delete_action.php" method="post" style="display:inline">
                                            <input type="hidden" name="sp_id" value="<?= $plan['id']?>">
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


