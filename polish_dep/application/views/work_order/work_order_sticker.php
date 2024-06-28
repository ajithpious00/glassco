<div class="main-panel">
    <div class="content-wrapper">
        <?php
        foreach ($view_details as $vd) {
            if ($vd->UN_Id == 1) {
                $heightmm = $vd->PD_Height * 10;
                $widthmm = $vd->PD_Width * 10;
            } elseif ($vd->UN_Id == 2) {
                $heightmm = $vd->PD_Height * 25.4;
                $widthmm = $vd->PD_Width * 25.4;
            } elseif ($vd->UN_Id == 3) {
                $heightmm = $vd->PD_Height * 304.79999025;
                $widthmm = $vd->PD_Width * 304.79999025;
            } else {
                $heightmm = $vd->PD_Height;
                $widthmm = $vd->PD_Width;
            }
            ?>
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card  border border-dark">
                        <div class="card-body">
                            <div class="color-font">
                                <h3 class="color-font"><strong>
                                        <center><img
                                                src="<?php echo base_url(); ?>assets/images/logo/imgpsh_fullsize_anim.jpg"
                                                width="200" height="50" alt="logo" />
                                            <center>
                                    </strong>
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <table style="width:100%" ;>
                                        <tr>
                                            <td>
                                                <div class="col-lg-6 grid-margin text-left">
                                                    <h4 class="color-font"><strong>
                                                            <?php echo $vd->PD_Order_No; ?>
                                                        </strong>
                                                    </h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12 text-right">
                                                    <h4 class="color-font"><strong>GT/CLT/PI-226</strong></h4>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="color-font">
                                <h3>
                                    <center>
                                        Size:
                                        <?php echo $heightmm;
                                        echo 'MM x ';
                                        echo $widthmm;
                                        echo 'MM ';
                                        echo '<br>';
                                        echo ucfirst($vd->Name); ?>
                                    </center>
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <table style="width:100%" ;>
                                        <tr>
                                            <td>
                                                <div class="col-lg-6 mt-3 grid-margin text-left">
                                                    <h4 class="color-font"><strong>QTY:
                                                            <?php echo $vd->PD_Quantity; ?>
                                                        </strong></h4>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12 text-right">
                                                    <h4 class="color-font"><strong><?php echo $vd->Edge_type; ?></strong></h4>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="color-font">
                                <h5>
                                    <center>
                                        <?php echo $customerdetail->CU_Name; ?>
                                    </center>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="panel panel-default text-right button-box">
            <div class="panel-body">
                <a class="btn btn-success" onclick="printDiv()"><i class="fa fa-print"></i> PRINT STICKER</a>
            </div>
        </div>
    </div>