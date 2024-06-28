<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
			
                <a href="<?php echo base_url();?>dashboard" class="navbar-brand mx-4 mb-3 lftmnu">
                    <h3 class="text-primary website_title"><img src="<?php echo base_url();?>assets/logo/logo_dashboard.jpeg"></h3>
                </a>
			
				
                
                <div class="navbar-nav w-100">
                    <a href="<?php echo base_url();?>dashboard" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
					<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Account Type</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>accounttype/accountTypelist" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>accounttype/accountTypeAdd" class="dropdown-item">Add</a>
                        </div>
                    </div>
					
					
					<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Account Sub Type</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>accountsubtype/accountSubTypelist" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>accountsubtype/accountSubTypeAdd" class="dropdown-item">Add</a>
                        </div>
                    </div>
					
					
					<div class="nav-item dropdown">
						<a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Account Head</a>
					    <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>accounthead/accountHeadList" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>accounthead/accountHeadAdd" class="dropdown-item">Add</a>
                        </div>
					</div>
					
					
					<div class="nav-item dropdown">
						<a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Account Sub Head</a>
					    <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>accountsubhead/accountSubHeadList" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>accountsubhead/accountSubHeadAdd" class="dropdown-item">Add</a>
                        </div>
					</div>
					
					
					<div class="nav-item dropdown">
						<a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Journal</a>
					    <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>journal" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>journal/journalAdd" class="dropdown-item">Add</a>
                        </div>
					</div>
					
					
					
					
					<div class="nav-item dropdown">
						<a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Ledger</a>
						 <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?php echo base_url();?>ledger" class="dropdown-item">List</a>
                            <a href="<?php echo base_url();?>ledger/ledgerAdd" class="dropdown-item">Add</a>
                        </div>
					</div>
					
					
					<a href="<?php echo base_url();?>trialbalance" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Trial Balance</a>
					
					<a href="<?php echo base_url();?>workorder" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Work Order</a>
					
					<a href="<?php echo base_url();?>balancesheet" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Balance Sheet</a>
					
                  <!--   <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
						<div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div> 
                    </div> 
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
					
					 <a href="<?php echo base_url();?>accounts/logout" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
		
		
		<!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="<?php echo base_url();?>dashboard" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <!--<form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>-->
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- <div class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>-->
                        <!--<div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php // echo base_url();?>assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">John send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php // echo base_url();?>assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">John send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php // echo base_url();?>assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">John send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>-->
                    <!--<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>-->
                     <!--<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php // echo base_url();?>assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                       <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>-->
                </div>
            </nav>
            <!-- Navbar End -->
