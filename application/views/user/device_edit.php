<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Device Form
                </div>
                <div class="tools">
                    <a class="collapse" href="javascript:;" data-original-title="" title="">
                    </a>
                    <a class="reload" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= base_url()?>user/device/update/<?=$page?>" id="deviceform" method="post">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Brand</label>
                                <select class="form-control valdation_select" id="Brand" name="brand" >
                                    <option value="">-----Select Brand-----</option>
                                    <?php
                                        foreach ($brandList as $value):
                                    ?>

                                    <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $devicedata->brand_id ? 'selected':""?>  ><?= $value->brand_name;?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span id="val_Brand" style="color: red"><?php echo form_error('brand'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Models</label>
                                <select class="form-control valdation_select" id="Model" name="model" >
                                    <option value="">-----Select Model-----</option>
                                    <?php
                                        foreach ($modelList as $value):
                                    ?>

                    <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $devicedata->model_id ? 'selected':""?>  ><?= $value->model_name;?></option>


                                    <?php endforeach; ?>
                                </select>
                                <span id="val_Model" style="color: red"><?php echo form_error('model'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Serial Number</label>
                            <input type="text" placeholder="Enter text" id="Serial" value="<?= $devicedata->serial_number;?>" name="serial_number" class="form-control valdation_check">
                            <span id="val_Serial" style="color: red"><?php echo form_error('serial_number'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">IMEI Number</label>
                            <input type="text" placeholder="Enter text" id="IMEI" value="<?= $devicedata->IMEI_number ;?>" name="IMEI_number" class="form-control valdation_check">
                            <span id="val_IMEI" style="color: red"><?php echo form_error('IMEI_number'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Sim Card</label>
                                <select class="form-control valdation_select" id="Sim" name="sim_card" >
                                    <option value="">-----Select Sim Card-----</option>
                                    <?php
                                        foreach ($simList as $value):
                                    ?>
        <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $devicedata->sim_card ? 'selected':""?>  ><?= $value->sim_no;?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span id="val_Sim" style="color: red"><?php echo form_error('sim_card'); ?></span>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Voltage</label>
                          <select class="form-control valdation_select" id="Voltage" name="voltage">
                            <option value="">-----Select Voltage-----</option>
                            <option value="1.50" <?= $devicedata->voltage == 1.50 ? 'selected':""?>>1.50 V</option>
                            <option value="3.25" <?= $devicedata->voltage == 3.25 ? 'selected':""?>>3.25 V</option>
                            <option value="5.50" <?= $devicedata->voltage == 5.50 ? 'selected':""?>>5.50 V</option>
                            <option value="2.50" <?= $devicedata->voltage == 2.50 ? 'selected':""?>>2.50 V</option>
                          </select>
                          <span id="val_Voltage" style="color: red"><?php echo form_error('voltage'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Color</label>
                                <select class="form-control valdation_select" id="Color" name="color" >
                                    <option value="">-----Select Color-----</option>
                                    <?php
                                        foreach ($colorList as $value):
                                    ?>
        <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $devicedata->color ? 'selected':""?>  ><?= $value->color;?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span id="val_Color" style="color: red"><?php echo form_error('color'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Meterial</label>
                                <select class="form-control valdation_select" id="Material" name="meterial" >
                                    <option value="">-----Select Meterial-----</option>
                                    <?php
                                        foreach ($meterialList as $value):
                                    ?>
        <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $devicedata->meterial ? 'selected':""?>  ><?= $value->meterial;?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span id="val_Material" style="color: red"><?php echo form_error('meterial'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Voice Activated</label>
                            <div>
                            <?php if($devicedata->voice_activated == 1) { ?>
                                <label class="radio-inline">
                                <input type="radio" value="1" name="voice_activated" checked="checked">Yes</label>
                                <label class="radio-inline">
                                <input type="radio" value="0" name="voice_activated" >No </label>
                            <?php  }
                                    else {
                             ?>
                                <label class="radio-inline">
                                <input type="radio" value="1" name="voice_activated" >Yes</label>
                                <label class="radio-inline">
                                <input type="radio" value="0" name="voice_activated" checked="checked">No </label>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $devicedata->id ;?>">
                    <div class="form-actions">
                        <input class="btn green" type="submit" value="Submit">
                        <a class="btn default" href="<?= base_url()?>user/device/<?=$page?>">Cancel</a>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
            //console.log($('#'+id).val());
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html('This field is required');
                flag = 1;
                //console.log('country '+flag);
            }

        });

        if(flag == 1) {

            e.preventDefault();
        }
});

</script>