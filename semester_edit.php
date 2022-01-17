<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])){
    header('location:admin.php');
    exit;
}
?>
<?php include_once 'template/_head.php'?>
<?php
    if (isset($_GET['sid'])){
        $semester_id = $_GET['sid'];
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM semesters WHERE id='$semester_id'";
        $result = $conn->query($sql);
        $semester = $result->fetch_assoc();
    }
?>
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
                    <h1>Semester management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Semester</li>
                        <li class="active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="row">
            <?php include_once '_messages.php'?>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Semester edit form</div>
                    <div class="card-body card-block">
                        <form action="semester_edit_action.php" method="POST" class="">
                            <input type="hidden" name="semester_id" value="<?= $semester['id']?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                    <input type="text" id="username" name="name" value="<?= $semester['name'] ?>" placeholder="Semester name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" id="username" name="start_date" value="<?= $semester['start_date'] ?>" placeholder="Start date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" id="username" name="end_date" value="<?= $semester['end_date'] ?>" placeholder="End date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                <br>
                                <input type="radio" name="status" <?php if($semester['status']=='Active'){echo 'checked';} ?>  value="Active" id="active">
                                <label for="active">Active</label>
                                <input type="radio" name="status" <?php if($semester['status']=='Inactive'){echo 'checked';} ?> value="Inactive" id="inactive">
                                <label for="inactive">Inactive</label>
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



