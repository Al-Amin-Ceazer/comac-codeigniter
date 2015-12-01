<div class="row">
<div class="col-md-12">
    <div class="profile-sidebar col-md-4">
                            <!-- PORTLET MAIN -->
        <div class="portlet light profile-sidebar-portlet">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <?php if($userdata->photo != ''):?>
                <img src="<?=base_url()?>assets/uploads/images/user/thumb/<?=$userdata->photo?>" class="img-responsive" alt="Profile Picture">
                <?php else:?>
                <img src="<?=base_url()?>assets/uploads/images/user/thumb/avatar.png" class="img-responsive" alt="Profile Picture">
                <?php endif;?>
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                     <?php
                        $f_name = $userdata->first_name;
                        $l_name = $userdata->last_name;
                        echo $full_name = $f_name." ".$l_name;
                     ?>
                </div>
                <div class="profile-usertitle-job">
                     <?php
                        foreach ($companyList as $value):
                    ?>

                    <?= isset($value) && $value->id == $userdata->company ? $value->name:""?>

                    <?php
                        endforeach;
                    ?>
                </div>
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
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <form action="<?= base_url()?>user/user/update/<?=$page?>" id="myform" class="login-form" method="post" role="form">
                                <!--form role="form" action="#"-->
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
                                        <input type="email" value="<?= $userdata->email ;?>" placeholder="something@email.com" id="email"  name="email" class="form-control" readonly/>
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
                                    <div class="form-group">
                                        <label class="control-label">Company</label>
                                            <select class="form-control valdation_select" id="Company" name="company" >
                                                <option value="">-----Select Company-----</option>
                                                <?php
                                                    foreach ($companyList as $value) {
                                                ?>

                                                <option value="<?= $value->id;?>"  <?=isset($value) && $value->id == $userdata->company ? 'selected':""?>  ><?= $value->name;?></option>

                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <span id="val_Company" style="color: red"><?php echo form_error('company'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Position</label>
                                        <input type="text" value="<?= $userdata->position ;?>" placeholder="Web Developer" id="Position" name="position" class="form-control valdation_check"/>
                                        <span id="val_Position" style="color: red"><?php echo form_error('position'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Type</label>
                                        <select class="form-control valdation_select" id="Type" name="type" >
                                            <option value="">-----Select Type-----</option>
                                                <?php $var = StaticDataArrays('user_type');
                                                    foreach ($var as $value):
                                                ?>
                                                <option value="<?=$value?>"  <?=$value == $userdata->type ? 'selected':""?> ><?=ucfirst($value)?></option>

                                                <?php
                                                    endforeach;
                                                ?>
                                        </select>
                                        <span id="val_Type" style="color: red"><?php echo form_error('type'); ?></span>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $userdata->id ;?>">
                                    <div class="margiv-top-10">
                                        <input class="btn green-haze" type="submit" value="Update User">

                                        <a href="<?= base_url()?>user/user/<?=$page?>" class="btn default">
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

<script type="text/javascript">

 $(".valdation_check").on('keypress keyup',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});

$(".valdation_select").on('click',function(){
    var nm = $(this).attr("id");
    $('#val_'+nm).html("");
});


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

</script>