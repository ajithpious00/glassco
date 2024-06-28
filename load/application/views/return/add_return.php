<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="message" align="center" style="display:none;"></div>
                        </div>
                        <form id="returnorder" name="returnorder" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <h3>Return Order</h3>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label for=" Workorder" class="font-color"><b>Select Work Order</b></label>
                                    <select data-live-search="true" id="woid" name="woid" class="searchform form-control" onchange="fetchdata()">
                                        <option value="" selected>Select Customer</option>
                                        <?php
                                        foreach ($workorder_name as $wo) {
                                        ?>
                                            <option value="<?= $wo->PD_Order_No; ?>"><?= $wo->PD_Order_No; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cuid" name="cuid" hidden value="">
                                </div>
                                <div class="form-group">
                                    <label for="userName" class="font-color"><b>Customer Full Name</b></label>
                                    <input type="text" class="form-control" id="cusname" name="cusname" placeholder="Customer Name" value="">
                                </div>
                                <div class="form-group">
                                    <label for="userPhone" class="font-color"><b>Phone Number</b></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Customer Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="userAdress" class="font-color"><b>Customer Address</b></label>
                                    <input type="text" class="form-control" id="adress" name="adress" placeholder="Customer Address">
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered text-center" id="product_field">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Product Name</b></label>
                                                    <select class="form-control select2" style="width: 90px;" name="productname[]" id="productname[]">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        if (count($product) > 0) {

                                                            foreach ($product as $pt) {
                                                        ?>
                                                                <option <?php if ($pt->ID == $data['ID']) {
                                                                            echo 'selected';
                                                                        } ?> value="<?= $pt->ID; ?>">
                                                                    <?= $pt->Name; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Height</b></label>
                                                    <input type="text" class="form-control" id="height[]" name="height[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Height">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Width</b></label>
                                                    <input type="text" class="form-control" id="width[]" name="width[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Width">
                                                </div>
                                            </td>
                                            <!-- <td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Wastage</b></label>
													<input type="text" class="form-control" id="wastage[]"
														name="wastage[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Wastage">
												</div>
											</td> -->
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Product Unit</b></label>
                                                    <select class="form-control select2" name="unit[]" id="unit[]">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        if (count($product_unit) > 0) {

                                                            foreach ($product_unit as $pu) {
                                                        ?>
                                                                <option <?php if ($pu->UN_Id == $data['UN_Id']) {
                                                                            echo 'selected';
                                                                        } ?> value="<?= $pu->UN_Id; ?>">
                                                                    <?= $pu->UN_Name; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Product Type</b></label>
                                                    <select class="form-control select2" style="width: 90px;" name="type[]" id="type[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if (count($product_type) > 0) {

                                                            foreach ($product_type as $pt) {
                                                        ?>
                                                                <option <?php if ($pt->ID == $data['ID']) {
                                                                            echo 'selected';
                                                                        } ?> value="<?= $pt->ID; ?>">
                                                                    <?= $pt->Edge_type; ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Quantity</b></label>
                                                    <input type="text" class="form-control" id="quantity[]" name="quantity[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Quantity">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="height" class="font-color"><b>Rate</b></label>
                                                    <input type="text" class="form-control" id="rate[]" name="rate[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Rate">
                                                </div>
                                            </td>
                                            <td><button type="button" name="addmore" id="addmore" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="file">Choose File:</label>
                                    <input type="file" class="form-control-file" id="file" name="file">
                                </div> -->
                                <div class="form-group">
                                    <label for="file"><b>Reason:</b></label>
                                    <textarea class="form-control" id="reason" name="reason" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="save" name="save" class="btn btn-primary">Save</button>
                                    <a href="<?php echo base_url(); ?>return_order">
                                        <button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
                                    </a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>