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
                    <h1>User management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="row">
            <?php include_once '_messages.php'?>
        </div>
        <?php
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM batches WHERE status='Active'";
        $batches= $conn->query($sql);
        $sql1 = "SELECT * FROM semesters WHERE status='Active'";
        $semesters= $conn->query($sql1);

        ?>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">User creation form</div>
                    <div class="card-body card-block">
                        <form action="create_seat_plan.php" method="POST" class="">
                            <div class="form-group">
                                <label class=""><b>Semester</b></label><br>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                    <select name="semester" id="select" class="form-control">
                                        <option value="">Select Semester</option>
                                        <?php foreach ($semesters as $semester){ ?>
                                            <option value="<?= $semester['id']?>"><?= $semester['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=""><b>First batch</b></label><br>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <select name="first_batch" id="select" class="form-control">
                                        <option value="">Select Batch</option>
                                        <?php foreach ($batches as $batch){ ?>
                                            <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=""><b>Second batch</b></label><br>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <select name="second_batch" id="select" class="form-control">
                                        <option value="">Select Batch</option>
                                        <?php foreach ($batches as $batch){ ?>
                                            <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>

        <!--/.col-->


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<?php include_once 'template/footer.php'?>
