<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])){
    header('location:admin.php');
    exit;
}
?>
<?php include_once 'template/_head.php'?>
<?php
    if (isset($_GET['bid'])){
        $batch_id = $_GET['bid'];
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM batches WHERE id='$batch_id'";
        $result = $conn->query($sql);
        $batch = $result->fetch_assoc();
        $sql = "SELECT * FROM departments";
        $departments= $conn->query($sql);
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
                    <h1>Batch management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Department</li>
                        <li class="active">Batch edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <?php include_once '_messages.php'?>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Batch edit form</div>
                    <div class="card-body card-block">
                        <form action="batch_edit_action.php" method="POST" class="">
                            <input type="hidden" name="batch_id" value="<?= $batch['id']?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="name" value="<?= $batch['name'] ?>" placeholder="Batch name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-info-circle"></i></div>
                                    <input type="text" id="username" name="details" value="<?= $batch['details'] ?>" placeholder="Details" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <select name="dept" id="select" class="form-control">
                                        <option value="">Select department</option>
                                        <?php foreach ($departments as $department){ ?>
                                            <option <?php if($batch['dept_id']==$department['id']){echo 'selected';} ?> value="<?= $department['id']?>"><?= $department['name']?>(<?= $department['slug']?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="co" value="<?= $batch['co_ordinator'] ?>" placeholder="Batch co-ordinator" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                <br>
                                <input type="radio" name="status" <?php if($batch['status']=='Active'){echo 'checked';} ?>  value="Active" id="active">
                                <label for="active">Active</label>
                                <input type="radio" name="status" <?php if($batch['status']=='Inactive'){echo 'checked';} ?> value="Inactive" id="inactive">
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



