<div class="row">
    <div class="col-md-12">
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> Sim Information
                </div>
                <div class="tools">
                    <a class="collapse" href="" data-original-title="" title="">
                    </a>
                    <a class="reload" href="" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url('user/sim_card/add')?>" id="myform1" role="form" class="form-horizontal" method="POST">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Sim No :</label>
                            <div class="col-lg-9">
                                <div class="input-icon right">
                                    <input type="text" id="Sim-No" name="sim_no" class="form-control valdation_check">
                                    <span id="val_Sim-No" style="color: red"><?php echo form_error('sim_no'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Phone No :</label>
                            <div class="col-lg-9">
                                <div class="input-icon right">
                                    <input type="text" id="Phone-No" name="phone_no" class="form-control valdation_check">
                                    <span id="val_Phone-No" style="color: red"><?php echo form_error('phone_no'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Carrier :</label>
                            <div class="col-lg-9">
                                <div class="input-icon right">
                                    <input type="text" id="Carrier" name="carrier" class="form-control valdation_check">
                                    <span id="val_Carrier" style="color: red"><?php echo form_error('carrier'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Activated Status :</label>
                            <div class="col-lg-9">
                                <label class="radio-inline"><input type="radio" value="1" name="activated">Yes &nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" value="0" name="activated" checked>No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input class="btn green" type="submit" value="Submit">
                            <a class="btn default" href="<?= base_url('user/sim_card');?>">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>

    $('#myform1').on('submit',function(e){

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

        if(flag == 1) {

            e.preventDefault();
        }
});

$(".valdation_check").on('keypress keyup',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});
</script>