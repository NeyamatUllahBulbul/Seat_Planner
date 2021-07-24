<?php session_start(); ?>
<?php include_once 'template/_head.php'?>
<?php
    if (isset($_GET['uid'])){
        $user_id = $_GET['uid'];
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

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
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Users</li>
                        <li class="active">User edit</li>
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
                    <div class="card-header">User edit form</div>
                    <div class="card-body card-block">
                        <form action="user_edit_action.php" method="POST" class="">
                            <input type="hidden" name="user_id" value="<?= $user['id']?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="name" value="<?= $user['name']?>" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="username" value="<?= $user['username']?>" placeholder="Username" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" id="email" name="email" value="<?= $user['email']?>" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                <br>
                                <input type="radio" name="status" <?php if($user['status']=='Active'){echo 'checked';} ?>  value="Active" id="active">
                                <label for="active">Active</label>
                                <input type="radio" name="status" <?php if($user['status']=='Inactive'){echo 'checked';} ?> value="Inactive" id="inactive">
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

