<body>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">Welcome Admin!</a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Manage Student</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list"></i><a href="student_index.php">All Students</a></li>
                        <li><i class="fa fa-plus-circle"></i><a href="student_create.php">Add Students</a></li>
                    </ul>
                </li>
                <li>
                    <a href="department_index.php"> <i class="menu-icon fa fa-building"></i>Manage Departments</a>
                </li>
                <li >
                    <a href="batch_index.php"> <i class="menu-icon fa fa-tasks"></i>Manage Batches</a>
                </li>
                <li>
                    <a href="user_index.php"> <i class="menu-icon fa fa-user"></i>Manage Users</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Seat Plan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list"></i><a href="create_seat_plan.php">Make seat plan</a></li>
                        <li><i class="fa fa-eye"></i><a href="seat_plan_index.php">View seat plans</a></li>
                    </ul>
                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
