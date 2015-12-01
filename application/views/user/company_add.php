<div class="row">
<div class="col-md-12">
    <div class="profile-content col-md-12 col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Company Create</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <form action="<?=base_url('user/company/add')?>" class="login-form" id="myform" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" placeholder="Company Name" id="Company-Name" name="company_name" class="form-control valdation_check"/>
                                        <span id="val_Company-Name" style="color: red"><?php echo form_error('company_name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Address</label>
                                        <input type="text" placeholder="Company Address" id="Company-Address" name="company_address" class="form-control valdation_check"/>
                                        <span id="val_Company-Address" style="color: red"><?php echo form_error('company_address'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company City</label>
                                        <input type="text" placeholder="Company City" id="Company-City" name="company_city" class="form-control valdation_check"/>
                                        <span id="val_Company-City" style="color: red"><?php echo form_error('company_city'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company State</label>
                                        <input type="text" placeholder="Company State" id="Company-State" name="company_state" class="form-control valdation_check"/>
                                        <span id="val_Company-State" style="color: red"><?php echo form_error('company_state'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" placeholder="Country" id="Country" name="company_country" class="form-control valdation_check"/>
                                        <span id="val_Country" style="color: red"><?php echo form_error('company_country'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Web Site</label>
                                        <input type="text" placeholder="https://www.google.com" id="Web-Site" name="company_web" class="form-control valdation_check"/>
                                        <span id="val_Web-Site" style="color: red"><?php echo form_error('company_web'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Logo</label>
                                        <input type="file" placeholder="Company Logo" id="Company-Logo" name="logo" class="form-control valdation_check" required/>

                                    </div>

                                    <div class="margiv-top-10">
                                        <input class="btn green-haze" type="submit" value="Save Company">

                                        <a href="<?= base_url()?>user/company" class="btn default">
                                        Cancel </a>
                                    </div>
                                </form>
                            </div>
                            <!-- END PERSONAL INFO TAB -->
                            <!-- CHANGE AVATAR TAB -->
                            <!-- END CHANGE AVATAR TAB -->
                            <!-- CHANGE PASSWORD TAB -->
                            <!-- END CHANGE PASSWORD TAB -->
                            <!-- PRIVACY SETTINGS TAB -->
                            <!-- END PRIVACY SETTINGS TAB -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PROFILE CONTENT -->
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">

 $(".valdation_check").on('keypress keyup',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});


 $('#myform').on('submit',function(e){

        var flag = 0;
        $('.valdation_check').each(function(){
            var id = $(this).attr('id');
            //console.log($('#'+id).val());
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html(id+' is required');
                flag = 1;
            }

        });



        if(flag == 1) {

            e.preventDefault();
        }
});

</script>