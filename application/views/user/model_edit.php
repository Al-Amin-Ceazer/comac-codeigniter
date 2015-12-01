<div class="row">
                    <div class="col-md-12">
                        <div class="portlet box purple">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-plus"></i>Edit Model
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
                                <form action="<?= base_url('user/model/update');?>" id="modelform" class="form-horizontal form-row-sepe" method="post">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Brand Name</label>
                                            <div class="col-md-4">
                                                <select class="form-control valdation_select" id="Brand" name="brand" >
                                                    <option value="">-----Select Brand-----</option>
                                                    <?php
                                                        foreach ($brandList as $value):
                                                    ?>

                                                    <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $modeldata[brand_id] ? 'selected':""?>  ><?= $value->brand_name;?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <span id="val_Brand" style="color: red"><?php echo form_error('brand'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Models</label>
                                            <div class="col-md-4">
                                                <input type="text" value="<?=$modeldata[model_name]?>" id="Model" name="model" class="form-control valdation_check">
                                                <span id="val_Model" style="color: red"><?php echo form_error('model'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Color</label>
                                            <div class="col-md-4">
                                        <?php //d($colorList)?>
                                                <select id="select2_sample2" name="color[]" class="form-control select2" multiple>
                                                    <?php
                                                        foreach ($colorList as $color):
                                                    ?>

                                                 <option value="<?= $color->id;?>" <?= in_array($color->id,$color_ar) ? "selected" : " " ?>><?= $color->color ?></option>

                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Material</label>
                                            <div class="col-md-4">
                                                <select id="meterial" name="meterial[]" class="form-control select2" multiple>

                                                    <?php
                                                        foreach ($meterialList as $meterial):
                                                    ?>
                                        <option value="<?= $meterial->id;?>" <?= in_array($meterial->id,$meterial_ar) ? "selected" : " " ?>><?=$meterial->meterial?></option>


                                                    <?php endforeach; ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?=$modeldata['id']?>">
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input class="btn green" type="submit" value="Update">
                                                <a class="btn default" href="<?= base_url('user/model');?>">Cancel</a>
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

    $('#modelform').on('submit',function(e){

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
