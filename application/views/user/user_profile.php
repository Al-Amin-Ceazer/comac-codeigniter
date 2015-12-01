<div class="row">
<div class="col-md-12">
    <div class="profile-sidebar col-md-4">
                            <!-- PORTLET MAIN -->
        <div class="portlet light profile-sidebar-portlet">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <?php if($userdata->photo != ''):?>
                    <img src="<?= base_url()."assets/uploads/images/user/thumb/".$userdata->photo;?>" class="img-responsive" alt="Profile Picture">
                <?php else:?>
                    <img alt="" class="img-responsive" src="<?=base_url()?>assets/admin/layout2/img/avatar.png"/>
                <?php endif;?>
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                     <?php
                        echo $this->session->userdata('user_name');
                     ?>
                </div>
                 <?php
                    $type = $this->session->userdata('type');
                        if($type != 'superadmin') {
                 ?>
                <div class="profile-usertitle-job">
                        <?php
                        foreach ($companyList as $value) {
                    ?>

                    <?= isset($value) && $value->id == $userdata->company ? $value->name:""?>

                    <?php
                        }
                    ?>
                </div>
                <?php } ?>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">

                <button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">

            </div>
            <!-- END MENU -->
        </div>
        <!-- END PORTLET MAIN -->
        <!-- PORTLET MAIN -->

        <!-- END PORTLET MAIN -->
    </div>
    <div class="profile-content col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">User Account</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                            </li>
                            <li>
                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <form action="<?=base_url('user/profile/index')?>" class="login-form" id="myform" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" value="<?= $userdata->first_name;?>" placeholder="John" id="First-Name" name="first_name" class="form-control valdation_check"/>
                                        <span id="val_First-Name" style="color: red"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" value="<?= $userdata->last_name ;?>" placeholder="Doe" id="Last-Name" name="last_name" class="form-control valdation_check"/>
                                        <span id="val_Last-Name" style="color: red"><?php echo form_error('last_name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" value="<?= $userdata->email ;?>" placeholder="something@email.com" id="email"  class="form-control" readonly/>
                                        <span id="error-email" style="color: red"><?php echo form_error('email'); ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" value="<?= $userdata->phone ;?>" placeholder="Password" id="Phone-Number" name="phone" class="form-control valdation_check"/>
                                        <span id="val_Phone-Number" style="color: red"><?php echo form_error('phone'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mobile Number</label>
                                        <input type="text" value="<?= $userdata->mobile ;?>" placeholder="+1 646 580 DEMO (6284)" id="Mobile-Number" name="mobile" class="form-control valdation_check"/>
                                        <span id="val_Mobile-Number" style="color: red"><?php echo form_error('mobile'); ?></span>
                                    </div>
                                    <?php
                                        if($this->session->userdata('type') != 'superadmin'):
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">Position</label>
                                        <input type="text" value="<?= $userdata->position ;?>" placeholder="Web Developer" id="Position"  class="form-control valdation_check" readonly/>
                                        <span id="val_Position" style="color: red"><?php echo form_error('position'); ?></span>
                                    </div>
                                    <?php endif;?>
                                    <div class="form-group">
                                        <label class="control-label">Picture</label>
                                        <input type="file" name="photo" class="form-control" />
                                    </div>
                                    <input type="hidden" name="id" value="<?= $userdata->id ;?>">
                                    <div class="margiv-top-10">
                                        <input class="btn green-haze" type="submit" value="Update User">
                                    </div>
                                </form>
                            </div>
                            <!-- END PERSONAL INFO TAB -->
                            <!-- CHANGE AVATAR TAB -->
                            <!-- END CHANGE AVATAR TAB -->
                            <!-- CHANGE PASSWORD TAB -->
                            <div class="tab-pane" id="tab_1_3">
                                <?php echo form_open('user/profile/updatePasword', 'class="login-form" id="myform2" role="form" '); ?>
                                    <div class="form-group">
                                        <label class="control-label">Current Password</label>
                                        <input type="password" id="Current-Password" name="current_password" class="form-control valdation_check2" placeholder="Current Password" required/>
                                        <span id="val_Current-Password" style="color: red"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="password" name="password" id="Password" class="form-control valdation_check2" placeholder="Type Password" required/>
                                        <span id="val_Password" style="color: red"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Re-type New Password</label>
                                        <input type="password" name="confirm_password" id="Confirm-Password" class="form-control valdation_check2" placeholder="Re-typePassword" required/>
                                        <span id="val_Confirm-Password" style="color: red"><?php echo form_error('confirm_password'); ?></span>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $userdata->id ;?>">
                                    <div class="margin-top-10">
                                        <input type="button" class="btn green-haze" id="btn-change-password" value="Change Password">

                                        <a href="<?= base_url()?>user/profile" class="btn default">
                                        Cancel </a>
                                    </div>
                                </form>
                            </div>
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

<script type="text/javascript">

 $(".valdation_check").on('keypress keyup',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});

$(".valdation_select").on('click',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});

$('#btn-change-password').on('click',function(){
    var flag = 0;
        $('.valdation_check2').each(function(){
            var id = $(this).attr('id');
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html(id+' is required');
                flag = 1;
            }

        });
    if(flag == 0)
        change_password()
})


 $('#myform').on('submit',function(e){

        var flag = 0;
        $('.valdation_check').each(function(){
            var id = $(this).attr('id');
            if($('#'+id).val() == '')
            {
                $('#val_'+id).html(id+' is required');
                flag = 1;
            }

        });


        $('.valdation_select').each(function(){
            var id = $(this).attr('id');
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

 function change_password()
            {
                var fl = 0;
                var send_url = "<?=base_url()?>user/profile/updatePassword";
                var current_password = $('#Current-Password').val();
                var password = $('#Password').val();
                var confirm_password = $('#Confirm-Password').val();
               // console.log(current_password+' '+password+' '+confirm_password);
                $.ajax({
                    url : send_url,
                    type : 'post',
                    async : false,
                    data : {'current_password' : current_password,
                            'password' : password,
                            'confirm_password' : confirm_password
                            },
                    dataType : 'json',
                    success: function(data,status){
                      if(status)
                      {
                        if(data.error ==  1)
                        {
                             $('#val_Current-Password').html("");
                             $('#val_Password').html("");

                            if(data.error_type == 'password_not_matched')
                            {
                                $('#val_Current-Password').html("Password mismatched.");
                            }
                            if(data.error_type == 'passwor_confirm_did_not_matched')
                            {

                                $('#val_Password').html("Password did not mathched with the confirm password.");
                            }

                        }
                        else
                        {
                            $('#val_Current-Password').html("");
                            $('#val_Password').html("");
                            $('#val_Confirm-Password').html("");

                            //$('#notifyMsg').html("Password Saved Successfully");
                            $('#alert-success-div').show();
                            $('#alert-success-message').html("Password Saved Successfully");

                            //window.location.replace("<?=base_url()?>user/profile");
                        }

                      }
                    },
                    error: function(xhr, desc, err){
                        //alert("Error");
                        alert("Details: " + desc + "\nError:" + err);
                    }
                });


            }

</script>
