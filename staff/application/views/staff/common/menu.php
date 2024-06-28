<div class="container-scroller">
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="<?php echo base_url(); ?>sales_enquiries"><img src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="100" height="100" alt="logo" /></a>
      <!--<img src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="50" height="50" alt="image">-->
      <!--<a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>admin/Home"><img src="<?php echo base_url(); ?>assets/admin/images/logo-mini.svg" alt="logo" /></a>-->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-img">
              <img src="<?php echo base_url(); ?>assets/admin/images/faces/user.jpg" alt="image">
            </div>
            <div class="nav-profile-text">
              <p class="mb-1 text-black">
                <?= $this->session->userdata['Name']; ?>
              </p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
            <div class="p-3 text-center bg-primary">
              <img class="img-avatar img-avatar48 img-avatar-thumb" src="<?php echo base_url(); ?>assets/admin/images/faces/user.jpg" alt="image">
            </div>
            <div class="p-2">
              <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
              <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                <a href="<?php echo base_url(); ?>logout"><span>Log Out</span></a>
                <i class="mdi mdi-logout ml-1"></i>
              </a>
            </div>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="position-fixed nav">
        <li class="nav-item sidebar-user-actions">
          <div class="user-details">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="d-flex align-items-center">
                  <div class="sidebar-profile-img">
                    <img src="<?php echo base_url(); ?>assets/admin/images/faces/user.jpg" width="40" height="40" alt="image">
                  </div>
                  <div class="sidebar-profile-text">
                    <p class="mb-1">
                      <?= $this->session->userdata['Name']; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>home">
            <span class="icon-bg"><i class="mdi mdi-home menu-icon"></i></span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>-->
        <!--<li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>user">
            <span class="icon-bg"><i class="fa fa-user menu-icon"></i></span>
            <span class="menu-title">Manage User</span>
          </a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>sales_enquiries">
            <span class="icon-bg"><i class="mdi mdi-package-variant menu-icon"></i></span>
            <span class="menu-title">Sales Enquiries</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>Mobile_app_enquiries">
            <span class="icon-bg"><i class="mdi mdi-cellphone-iphone menu-icon"></i></span>
            <span class="menu-title">Mobile App Enquiries</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>work_order">
            <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
            <span class="menu-title">Work Order</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>rejected_enquiries">
            <span class="icon-bg"><i class="mdi mdi-do-not-disturb menu-icon"></i></span>
            <span class="menu-title">Rejected Enquiries</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>approved_enquiries">
            <span class="icon-bg"><i class="mdi mdi-checkbox-multiple-marked menu-icon"></i></span>
            <span class="menu-title">Approved Enquiries</span>
          </a>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>delivery_products">
            <span class="icon-bg"><i class="mdi mdi-checkbox-multiple-marked menu-icon"></i></span>
            <span class="menu-title">Delivered Products</span>
          </a>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>return_order">
            <span class="icon-bg"><i class="mdi mdi-checkbox-multiple-marked menu-icon"></i></span>
            <span class="menu-title">Return Orders</span>
          </a>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>customer_invoice">
            <span class="icon-bg"><i class="mdi mdi-checkbox-multiple-marked menu-icon"></i></span>
            <span class="menu-title">Customer Invoices</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>delete_enquiries">
            <span class="icon-bg"><i class="mdi mdi-delete-sweep  menu-icon"></i></span>
            <span class="menu-title">Trash</span>
          </a>
        </li>
        <li class="nav-item sidebar-user-actions">
          <div class="sidebar-user-menu">
            <a href="<?php echo base_url(); ?>logout" class="nav-link">
              <i class="mdi mdi-logout menu-icon menu-icon"></i>
              <span class="menu-title">Log Out</span></a>
          </div>
        </li>
      </ul>
    </nav>