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
                        <a href="user_create.php" class="btn btn-sm btn-warning">Add New</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'database_connection.php';
    $conn = connect();
    $sql = "SELECT * FROM users";
    $users= $conn->query($sql);
    $serial = 1;
    ?>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All users</strong>
                    </div>
                    <div class="card-body text-center">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 3px;">Sl</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($users as $user){
                                ?>
                                    <tr>
                                        <td><?= $serial++?></td>
                                        <td><?= $user['name']?></td>
                                        <td><?= $user['username']?></td>
                                        <td><?= $user['email']?></td>
                                        <td>
                                            <a  href="user_edit.php?uid=<?= $user['id']?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                            <form class="" action="user_delete_action.php" method="post" style="display:inline">
                                                <input type="hidden" name="user_id" value="<?= $user['id']?>">
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
