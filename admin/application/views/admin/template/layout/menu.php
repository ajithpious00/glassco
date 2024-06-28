 <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         <a class="navbar-brand brand-logo" href="<?php echo base_url();?>admin/viewuser"><img src="<?php echo base_url();?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="100" height="100" alt="logo"/></a>
		 <!--<img src="<?php echo base_url();?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="50" height="50" alt="image">-->
		 
          <!--<a class="navbar-brand brand-logo-mini" href="<?php echo base_url();?>admin/Home"><img src="<?php echo base_url();?>assets/admin/images/logo-mini.svg" alt="logo" /></a>-->
        </div>
		
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
         
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?php echo base_url();?>assets/admin/images/faces/user.jpg" alt="image">
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?= $this->session->userdata['username']; ?><!--   <?= $this->session->userdata['Name']; ?>--></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <div class="p-3 text-center bg-primary">
                  <img class="img-avatar img-avatar48 img-avatar-thumb" src="<?php echo base_url();?>assets/admin/images/faces/user.jpg" alt="image">
                </div>
                <div class="p-2">
                <!-- <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Profile</span>
                    <span class="p-0">
                      <span class="badge badge-success">1</span>
                      <i class="mdi mdi-account-outline ml-1"></i>
                    </span>
                  </a>-->
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    <span><a href="<?php echo base_url();?>admin/settings/display">Settings</a></span>
                    <i class="mdi mdi-settings"></i>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span><a href="<?php echo base_url();?>admin/login/logout">Log Out</a></span>
                    <i class="mdi mdi-lock ml-1"></i>
                  </a>
                </div>
              </div>
            </li>
            <!--<li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              
            </li>-->
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
		  <li class="nav-item sidebar-user-actions">
              <!--<div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      <div class="sidebar-profile-img">
                        <img src="<?php echo base_url();?>assets/admin/images/faces/user.jpg" width="40" height="40" alt="image">
                      </div>
                      <div class="sidebar-profile-text">
                        <p class="mb-1"><?= $this->session->userdata['username']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>-->
		    </li>
			<li class="nav-item nav-category">Main</li>
            <!--<li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/home">
				<span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>-->
           
			<li class="nav-item">
              <a class="nav-link" href="<?php echo base_url();?>admin/viewuser">
				<span class="icon-bg"><i class="fa fa-user" aria-hidden="true"></i></span>
                <span class="menu-title">Users</span>
              </a>
            </li>
			<li class="nav-item" >
             <a class="nav-link" href="<?php echo base_url();?>admin/viewglass">
                <span class="icon-bg"><i class="fa fa-square" aria-hidden="true"></i></span>
                <span class="menu-title">Glass Edges</span>
              </a>
			  <!--<div class="collapse" id="ui-edge">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/viewglass">List</a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/edge">Add</a></li>
                </ul>
             </div>-->
            </li>
			<li class="nav-item" >
               <a class="nav-link" href="<?php echo base_url();?>admin/viewcategories">
                <span class="icon-bg"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                <span class="menu-title">Category</span>
              </a>
			 
            </li>
			<li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/viewsubcategory">
                <span class="icon-bg"><i class="fa fa-th" aria-hidden="true"></i></span>
                <span class="menu-title">Sub Category</span>
              </a>
			 <!-- <div class="collapse" id="ui-subcategory">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/viewsubcategory">List</a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/subcategory">Add</a></li>
                </ul>
              </div>-->
            </li>
			<li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/viewbrand">
                <span class="icon-bg"><i class="fa fa-barcode" aria-hidden="true"></i></span>
                <span class="menu-title">Brand</span>
              </a>
			 <!-- <div class="collapse" id="ui-brand">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/viewbrand">List</a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/brand">Add</a></li>
                </ul>
              </div>-->
            </li>
			<li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/product">
                <span class="icon-bg"><i class="fa fa-cubes" aria-hidden="true"></i></span>
                <span class="menu-title">Product</span>
              </a>
			 <!-- <div class="collapse" id="ui-product">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/viewproduct">List</a></li>
				  <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/product">Add</a></li>
                </ul>
              </div>-->
            </li>
            <!--<li class="nav-item documentation-link">
              <a class="nav-link" href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html" target="_blank">
                <span class="icon-bg">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                </span>
                <span class="menu-title">Documentation</span>
              </a>
            </li>-->
            <li class="nav-item" >
               <a class="nav-link" href="<?php echo base_url();?>admin/agents">
                <span class="icon-bg"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                <span class="menu-title">Agents</span>
              </a>
			 
            </li>
			<li class="nav-item" >
               <a class="nav-link" href="<?php echo base_url();?>admin/polish">
                <span class="icon-bg"><i class="fa fa-th-large" aria-hidden="true"></i></span>
                <span class="menu-title">Polish</span>
              </a>
            </li>
            <li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/settings/display">
                <span class="icon-bg"><i class="fa fa-cog" aria-hidden="true"></i></span>
                <span class="menu-title">Settings</span>
              </a>
			</li>
			<li class="nav-item" >
              <a class="nav-link" href="<?php echo base_url();?>admin/login/logout">
                <span class="icon-bg"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <span class="menu-title">Logout</span>
              </a>
			</li>
			</ul>
        </nav>