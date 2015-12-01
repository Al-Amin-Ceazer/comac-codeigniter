        <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>Device Details Information
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;" data-original-title="" title="">
                        </a>
                        <a class="reload" href="javascript:;" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form class="form-horizontal" action="#">
                        <div class="form-body">
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Brand Name</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= ucfirst($brand_name[$devicedata->brand_id]);?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Model Name</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= ucfirst($model_name[$devicedata->model_id]);?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Serial Number</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= $devicedata->serial_number;?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">IMEI Number</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= $devicedata->IMEI_number;?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Sim Card</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= ucfirst($sim_no[$devicedata->sim_card]);?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Voltage</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                    <?= $devicedata->voltage;?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Color</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                   <?=ucfirst($color_no[$devicedata->color]) ;?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Material</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                   <?= ucfirst($meterial_no[$devicedata->meterial]);?></span>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="col-md-3 control-label">Voice Activated</label>
                                <div class="col-md-4">
                                    <span class="form-control">
                                        <?php
                                            if($devicedata->voice_activated == 1) {
                                        ?>
                                        <td><?= YES; ?></td>
                                        <?php
                                        }
                                            else  {
                                        ?>
                                        <td><?= NO;?></td>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a class="btn default" href="<?= base_url('user/dashboard')?>">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>