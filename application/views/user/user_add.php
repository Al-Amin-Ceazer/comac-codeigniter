<div class="row">
<div class="col-md-12">
    <div class="profile-content col-md-12 col-sm-12">
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
                                <?php echo form_open('user/user/add', 'class="login-form" id="myform" role="form" '); ?>
                                <!--form role="form" action="#"-->
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" placeholder="John" id="First-Name" name="first_name" class="form-control valdation_check"/>
                                        <span id="val_First-Name" style="color: red"><?php echo form_error('first_name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" placeholder="Doe" id="Last-Name" name="last_name" class="form-control valdation_check"/>
                                        <span id="val_Last-Name" style="color: red"><?php echo form_error('last_name'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" placeholder="something@email.com" id="email"  name="email" class="form-control"/>
                                        <span id="error-email" style="color: red"><?php echo form_error('email'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" placeholder="Password" id="Password" name="password" class="form-control valdation_check"/>
                                        <span id="val_Password" style="color: red"><?php echo form_error('password'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="password" placeholder="Re-typePassword" id="Confirm-Password" name="confirm_password" class="form-control valdation_check"/>
                                        <span id="val_Confirm-Password" style="color: red"><?php echo form_error('confirm_password'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" placeholder="Password" id="Phone-Number" name="phone" class="form-control valdation_check"/>
                                        <span id="val_Phone-Number" style="color: red"><?php echo form_error('phone'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mobile Number</label>
                                        <input type="text" placeholder="+1 646 580 DEMO (6284)" id="Mobile-Number" name="mobile" class="form-control valdation_check"/>
                                        <span id="val_Mobile-Number" style="color: red"><?php echo form_error('mobile'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Company</label>
                                            <select class="form-control valdation_select" id="Company" name="company" >
                                                <option value="">-----Select Company-----</option>
                                                <?php
                                                    foreach ($companyList as $value) {

                                                ?>
                                                <option value="<?= $value->id;?>"><?= $value->name;?></option>

                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <span id="val_Company" style="color: red"><?php echo form_error('company'); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Position</label>
                                        <input type="text" placeholder="Web Developer" id="Position" name="position" class="form-control valdation_check"/>
                                        <span id="val_Position" style="color: red"><?php echo form_error('position'); ?></span>
                                    </div>
                                    <?php if($type == 'superadmin'):?>
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select class="form-control valdation_select" id="Type" name="type" >
                                                <option value="">-----Select Type-----</option>
                                                <?php $var = StaticDataArrays('user_type');
                                                    foreach ($var as $value):
                                                ?>
                                                <option value="<?=$value?>"><?=ucfirst($value)?></option>

                                                <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                            <span id="val_Type" style="color: red"><?php echo form_error('type'); ?></span>
                                        </div>
                                    <?php endif;?>

                                    <div class="margiv-top-10">
                                        <input class="btn green-haze" type="submit" value="Save User">

                                        <a href="<?= base_url()?>user/user" class="btn default">
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

$(document).ready(function(){
        $("#email").blur(function(){
            email_validate();
        });
    });

     function email_validate()
    {
        var result;
        var url = "<?=base_url()?>user/user/chk_email";
        var email = $("#email").val();

        if(valid_email_format(email)) {

            $('#error-email').html("");
             $.ajax({
                    url   :url,
                    async : false,
                    data:{                  // data that will be sent
                        email:email
                    },
                    type:"POST",            // type of submision
                    success:function(data){
                        console.log("sucess "+data);
                        if(data == 1) {
                            $("#error-email").html('<span style="color:red"> This <b>Email</b> Is All ready Exist</span>');
                            result = 0;
                        }
                        else{
                            $("#error-email").html('<span style="color:green"> This <b>Email</b> Is Avaiable</span>');
                            result = 1;
                        }
                    },
                     error: function(xhr, desc, err) {

                        //alert("Error");
                        //console.log("Details: " + desc + "\nError:" + err);
                        return 0;
                    }
                });
        } else {
            $('#error-email').html('<span style="color:red"> This <b>Email</b> Is Invalid Format</span>');
            return 0;
        }
        return result;
    }

function valid_email_format(email)
    {
        var re = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        var is_email=re.test(email);

        if(!is_email) {
            return false;
        }
        return true;
    }

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

        var em = email_validate();

        if(!em || flag == 1) {

            e.preventDefault();
        }

        if($('#Password').val() != $('#Confirm-Password').val()) {

            $('#val_Confirm-Password').html("Confirm Password don't match");
            e.preventDefault();
        }
});

</script>