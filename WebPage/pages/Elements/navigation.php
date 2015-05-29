<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Pi <?php echo $Pi_Number ?>: <?php echo $pageSensor ?></a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
                            <a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="sensor1.php"><i class="fa fa-dashboard fa-fw"></i> <?php echo $SENSOR1 ?></a>
                        </li>
                        <li>
                            <a href="sensor2.php"><i class="fa fa-dashboard fa-fw"></i> <?php echo $SENSOR2 ?></a>
                        </li>
                        <li>
                            <a href="sensor3.php"><i class="fa fa-dashboard fa-fw"></i> <?php echo $SENSOR3 ?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
