<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="#"><img
                    src="<?php echo base_url(); ?>assets/images/logo/imgpsh_fullsize_anim.jpg" width="100%" height="100%"
                    alt="logo" /></a>
            <!--<img src="<?php echo base_url(); ?>assets/images/logo/imgpsh_fullsize_anim.jpg" width="50" height="50" alt="image">-->

            <!--<a class="navbar-brand brand-logo-mini" href="<?php echo base_url(); ?>Home"><img src="<?php echo base_url(); ?>assets/images/logo-mini.svg" alt="logo" /></a>-->
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        <div class="nav-profile-img mx-0">
                            <img src="<?php echo base_url(); ?>assets/images/faces/user.jpg" alt="image">
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">
                                <?= $this->session->userdata['US_Name']; ?>
                            </p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                        aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                        <div class="p-3 text-center bg-primary">
                            <img class="img-avatar img-avatar48 img-avatar-thumb"
                                src="<?php echo base_url(); ?>assets/images/faces/user.jpg" alt="image">
                        </div>
                        <div class="p-2">
                            <!-- <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                                <span>Inbox</span>
                                <span class="p-0">
                                    <span class="badge badge-primary">3</span>
                                    <i class="mdi mdi-email-open-outline ml-1"></i>
                                </span>
                            </a>
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                                <span>Profile</span>
                                <span class="p-0">
                                    <span class="badge badge-success">1</span>
                                    <i class="mdi mdi-account-outline ml-1"></i>
                                </span>
                            </a>
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span>Settings</span>
                                <i class="mdi mdi-settings"></i>
                            </a> -->
                            <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                            <div role="separator" class="dropdown-divider"></div>
                            <!-- <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                                <span>Lock Account</span>
                                <i class="mdi mdi-lock ml-1"></i>
                            </a> -->
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                                <a href="<?php echo base_url(); ?>logout"><span>Log Out</span></a>
                                <i class="mdi mdi-logout ml-1"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                        data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="count-symbol bg-danger"></span>
                    </a>
                </li> -->
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
                                        <img src="<?php echo base_url(); ?>assets/images/faces/user.jpg" width="40"
                                            height="40" class="rounded-circle" alt="image">
                                    </div>
                                    <div class="sidebar-profile-text">
                                        <p class="my-2 px-1">
                                            <?= $this->session->userdata['US_Name']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>Workorder">
                        <span class="icon-bg"><i class="mdi mdi-briefcase-outline"></i></span>
                        <span class="menu-title">Work order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>history">
                        <span class="icon-bg"><i class="mdi mdi-history"></i></span>
                        <span class="menu-title">History</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>Performainvoice">
                        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                        <span class="menu-title">Perfoma Invoice</span>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                        <span class="menu-title">Category</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?php echo base_url(); ?>admin/viewcategory">List</a></li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?php echo base_url(); ?>admin/category">Add</a></li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item sidebar-user-actions">
                    <div class="sidebar-user-menu">
                        <a href="<?php echo base_url(); ?>logout" class="nav-link"><i
                                class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Log Out</span></a>
                    </div>
                </li>
            </ul>
        </nav>