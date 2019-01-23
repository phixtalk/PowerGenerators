<?php
$passport = $this->session->userdata('passport');
if($passport==""){
	$passport="user/dist/img/avatarr.png";
}
?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url("dashboard")?>" class="logo" style="background-color:#fff">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>N</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
		<img src="<?=base_url("assets/images/logo/gen_logo.png")?>" width="230px" style="margin-top:-18px;margin-left:-18px;">
	</span>
	  
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color:#222d32">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a style="cursor:default" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="<?=base_url("assets/user/dist/img/avatarr.png")?>" class="user-image" alt="User Image">-->
              <span class="hidden-xs">Welcome: <?=$this->session->userdata('firstname')." ".$this->session->userdata('lastname')?></span>
            </a>            
          </li>		  
          <!-- Control Sidebar Toggle Button -->
			<?	
				if($this->session->userdata('isadmin')==1){
			?>
				  <li>
					<a href="#" style="cursor:default" data-toggle="control-sidebar">Total Customers: <?=$this->db->count_all('userbase')?></a>
				  </li>
			<?	}?>
			<li class="dropdown user user-menu">
				<a style="color:#ff9900" href="<?php echo base_url('handlers/handle/logout')?>"><i class="fa fa-power-off"></i> Logout</a>            
			</li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url("assets/".$passport)?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('firstname')." ".$this->session->userdata('lastname')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <b style="font-size:16px">Online <?=$this->session->userdata('currentlevel')?></b></a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?=($this->session->userdata('isadmin')==1?"ADMIN":"MEMBER")?> TOOLS</li>
		
		<li <?=$current==1?" class='active'":""?>>
			<a href="<?=base_url($this->session->userdata('isadmin')==1?"cpanel":"dashboard")?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
		</li>
				
		<li class="treeview <?=$current==3||$current==23||$current==24||$current==25?"active":""?>">
		  <a href="#">
			<i class="fa fa-user"></i> <span>My Profile</span
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li <?=$current==3?" class='active'":""?>><a href="<?=base_url("profile/")?>"><i class="fa fa-circle-o"></i> <span>View Profile</span></a></li>
			<li <?=$current==24?" class='active'":""?>><a href="<?=base_url("profile/edit")?>"><i class="fa fa-circle-o"></i> <span>Edit Profile</span></a></li>
		  </ul>
		</li>
		
		<?	if($this->session->userdata('isadmin')==1){?>
		
				<li <?=$current==10?" class='active'":""?>><a href="<?=base_url("cpanel/service_requests")?>"><i class="fa fa-external-link"></i> Manage Service Requests </a></li>
				<li <?=$current==12?" class='active'":""?>><a href="<?=base_url("cpanel/service_schedule")?>"><i class="fa fa-clock-o"></i> Service Schedule Logs</a></li>
				<li <?=$current==14?" class='active'":""?>><a href="<?=base_url("cpanel/invoices")?>"><i class="fa fa-file-text"></i> Invoices</a></li>
				<li <?=$current==13?" class='active'":""?>><a href="<?=base_url("cpanel/inventory")?>"><i class="fa fa-th"></i> Manage Inventory</a></li>
				<li <?=$current==11?" class='active'":""?>><a href="<?=base_url("cpanel/employees")?>"><i class="fa fa-group"></i> Manage Employees</a></li>
				<li <?=$current==16?" class='active'":""?>><a href="<?=base_url("cpanel/customers")?>"><i class="fa fa-group"></i> Manage Customers</a></li>
				<!--
				<li <?=$current==15?" class='active'":""?>><a href="#"><i class="fa fa-circle-o"></i> Reports</a></li>
				-->
		<?	}else{?>
				<li <?=$current==2?" class='active'":""?>><a href="<?=base_url("services/new_request")?>"><i class="fa fa-wrench"></i> <span>Request New Service</span></a></li>
				<li <?=$current==7?" class='active'":""?>><a href="<?=base_url("services")?>"><i class="fa fa-external-link"></i> My Service History</a></li>
				<li <?=$current==8?" class='active'":""?>><a href="<?=base_url("services/bills")?>"><i class="fa fa-money"></i> My Bills</a></li>
		<? 	}?>
				
        <li><a href="<?php echo base_url('handlers/handle/logout')?>"><i class="fa fa-circle-o text-aqua"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
