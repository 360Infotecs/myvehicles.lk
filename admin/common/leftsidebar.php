<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            

          <!--  <li class="treeview">-->
              <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a></li>
              <!--<ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-car text-yellow"></i> <span>Vehicle Manager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="vehicle_registration.php"><i class="fa fa-plus"></i> Add Vehicle</a></li>
                <li><a href="index2.html"><i class="fa fa-car"></i> Manage Vehicles</a></li>
                <li><a href="index2.html"><i class="fa fa-car"></i> My Vehicles</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building-o text-yellow"></i> <span>Company Manager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <?php
                if($_SESSION['UserLevelId']=='5' or $_SESSION['UserLevelId']=='4')
                {
                //echo'<li><a href="company_manager.php"><i class="fa fa-building"></i> Manage Companies</a></li>';
                echo'<li><a href="index2.html"><i class="fa fa-building"></i> My Company</a></li>';
                }
                else
                {
				echo'<li><a href="company_manager.php"><i class="fa fa-building"></i> Manage Companies</a></li>';
                echo'<li><a href="index2.html"><i class="fa fa-building"></i> My Company</a></li>';
				}
                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users text-yellow"></i> <span>User Manager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <?php
              if($_SESSION['UserLevelId']=='5')
              {
			  	//echo'<li><a href="user_manager.php"><i class="fa fa-user-times"></i> Manage Users</a></li>';
			  	echo'<li><a href="index2.html"><i class="fa fa-user"></i> My User Profile</a></li>';
			  }
			  else
			  {
			  	echo'<li><a href="user_manager.php"><i class="fa fa-user-times"></i> Manage Users</a></li>';
                echo'<li><a href="index2.html"><i class="fa fa-user"></i> My User Profile</a></li>';
			  }
              	
                ?>
              </ul>
            </li>

            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
      </aside>