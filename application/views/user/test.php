<div class="row">
                    <div class="col-md-12">
                        <div class="portlet box purple">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Select 2 Dropdowns
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?= base_url('user/device/add');?>" id="deviceform" class="form-horizontal form-row-sepe" method="post">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Brand Name</label>
                                            <div class="col-md-4">
                                                <select class="form-control valdation_select" id="Brand" name="brand" >
                                                    <option value="">-----Select Brand-----</option>
                                                    <?php
                                                        foreach ($brandList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"><?= $value->brand_name;?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <span id="val_Brand" style="color: red"><?php echo form_error('brand'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Models</label>
                                            <div class="col-md-4">
                                                <select class="form-control valdation_select" id="Model" name="model" >
                                                    <option value="">-----Select Model-----</option>
                                                    <?php
                                                        foreach ($modelList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"><?= $value->model_name;?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <span id="val_Model" style="color: red"><?php echo form_error('model'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Serial Number</label>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="Enter text" id="Serial" name="serial_number" class="form-control valdation_check">
                                                <span id="val_Serial" style="color: red"><?php echo form_error('serial_number'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group last">
                                            <label class="col-md-3 control-label">IMEI Number</label>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="Enter text" id="IMEI" name="IMEI_number" class="form-control valdation_check">
                                                <span id="val_IMEI" style="color: red"><?php echo form_error('IMEI_number'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group last">
                                            <label class="col-md-3 control-label">Sim Card</label>
                                            <div class="col-md-4">
                                                <select class="form-control valdation_select" id="Sim" name="sim_card" >
                                                    <option value="">-----Select Sim Card-----</option>
                                                    <?php
                                                        foreach ($simList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"><?= $value->sim_no;?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <span id="val_Sim" style="color: red"><?php echo form_error('sim_card'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group last">
                                            <label class="col-md-3 control-label">Voltage</label>
                                            <div class="col-md-4">
                                                  <select class="form-control valdation_select" id="Voltage" name="voltage">
                                                        <option value="">-----Select Voltage-----</option>
                                                        <option value="1.50">1.50 V</option>
                                                        <option value="5.50">3.25 V</option>
                                                        <option value="5.50">5.50 V</option>
                                                        <option value="2.50">2.50 V</option>
                                                  </select>
                                                  <span id="val_Voltage" style="color: red"><?php echo form_error('voltage'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Color</label>
                                            <div class="col-md-4">
                                                <select id="select2_sample2" name="color[]" class="form-control select2" multiple>
                                                    <?php
                                                        foreach ($colorList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"><?= $value->color;?></option>

                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Material</label>
                                            <div class="col-md-4">
                                                <select id="meterial" name="meterial[]" class="form-control select2" multiple>

                                                    <?php
                                                        foreach ($materialList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"><?= $value->meterial;?></option>

                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Voice Activated</label>
                                            <div class="col-md-4">
                                                <label class="radio-inline">
                                                <input type="radio" value="1" name="voice_activated">Yes</label>&nbsp;&nbsp;
                                                <label class="radio-inline">
                                                <input type="radio" value="0" name="voice_activated" checked="checked">No </label>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input class="btn green" type="submit" value="Submit">
                                                <a class="btn default" href="<?= base_url('user/device');?>">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>

<script>

$(".valdation_check").on('keypress keyup',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});

$(".valdation_select").on('click',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});

    $('#deviceform').on('submit',function(e){

        var flag = 0;
        $('.valdation_check').each(function(){
            var id = $(this).attr('id');
            console.log($('#'+id).val());
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html('This field is required');
                flag = 1;
            }

        });

        $('.valdation_select').each(function(){
            var id = $(this).attr('id');
            console.log($('#'+id).val());
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html('This field is required');
                flag = 1;
                console.log('country '+flag);
            }

        });

        if(flag == 1) {

            e.preventDefault();
        }
});

</script>
