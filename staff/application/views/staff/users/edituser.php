<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit User Details</h4>
                        <!--<p class="card-description"> Basic form elements </p>-->
                        <form class="forms-sample" name="userForm" id="userForm" method="post">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="userName">Name</label>
                                <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="userEmail">Email address</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="userMobile">Mobile Number</label>
                                <input type="text" class="form-control" id="userMobile" name="userMobile" value="<?php echo $mobile; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Usertype">User Type</label>
                                <select name="usertype" id="usertype" class="form-control" disabled>
                                    <option value=""></option>
                                    <?php
                                    foreach ($ustype->result() as $row) {
                                        if ($usertype == $row->ID) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>

                                        <option value="<?php echo $row->ID; ?>" <?php echo $selected; ?>><?php echo $row->Type; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if ($usertype == 5) {
                            ?>
                                <div class="form-group" id="saleArea">
                                    <label for="executiveSaleArea">City/Area of Sale</label>
                                    <input type="text" class="form-control" id="executiveSaleArea" name="executiveSaleArea" value="<?php echo $city; ?>">
                                </div>
                            <?php
                            }
                            ?>
                            <button type="button" class="btn btn-primary mr-2" name="saveUser" id="saveUser">Save</button>
                            <a href="<?php echo base_url(); ?>user"><button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button></a>
                            <div class="finish-holder">
                                <div class="clearfix">&nbsp;</div>
                                <div class="alert alert-success" role="alert" id="finished"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>