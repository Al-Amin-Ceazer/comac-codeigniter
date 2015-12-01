
<div class="row">
        <div class="col-md-12">
            <div class="portlet light">

            <!--Header Fixed -->
                    <div class="portlet-title tabbable-line">

                                <div class="caption caption-md">

                                        <ul class="nav nav-tabs">
                                                <li class="compose-btn" >
                                                    <a class="btn blue" href="<?= base_url('user/message')?>">
                                                     Inbox (<?=count($receive_message_number)?>)</a>
                                                </li>
                                                <li class="compose-btn" >
                                                    <a class="btn green" href="<?= base_url('user/message/sentbox')?>" >
                                                     Sent Box (<?=count($sent_message_number)?>)</a>
                                                </li>
                                                <li class="compose-btn" >
                                                    <a class="btn red" href="<?= base_url('user/message/create')?>" >
                                                    <i class="fa fa-edit"></i> Compose </a>
                                                </li>
                                        </ul>

                                </div>

                    </div>

            <!--Header End -->

            <!--Message Content Start -->
                    <div id="tab_1_3" class="tab-pane">
                            <?php echo form_open('user/message/add', 'id="myform" role="form" '); ?>
                                <?php if($this->session->userdata('type') != 'admin'):?>
                                <div class="form-group">
                                    <label class="control-label">To</label>
                                        <select class="form-control valdation_select" id="To" name="to" required>
                                            <option value="">-----Select Person-----</option>
                                             <?php
                                                foreach ($userList as $value) {
                                                    $f_name = $value->first_name;
                                                    $l_name = $value->last_name;
                                                    $full_name = $f_name." ".$l_name;
                                                ?>
                                                <option value="<?= $value->id;?>"><?= ucfirst($full_name);?></option>

                                                <?php
                                                    }
                                                 ?>
                                         </select>
                                    <span id="val_To" style="color: red"><?php echo form_error('to'); ?></span>
                                </div>
                                <?php endif;?>
                                <div class="form-group">
                                    <label class="control-label">Subject</label>
                                    <input type="text" id="Subject" name="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Message</label>
                                    <textarea class="form-control" id="Message" name="message" rows="4" required></textarea>
                                </div>
                                <input type="hidden" id="From" name="from" value="<?= $this->session->userdata('user_id');?>">
                                <div class="margin-top-10">
                                    <input class="btn green-haze" type="submit" value="Sent">

                                    <a class="btn default" href="<?= base_url()?>user/message">
                                    Cancel </a>
                                </div>
                            </form>
                        </div>
            <!-- End Message Content -->

            </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){

        $('#myform').on('submit',function(e){

             e.preventDefault();

                var send_url = "<?=base_url()?>user/message/add";
                var to = $('#To').val();
                var subject = $('#Subject').val();
                var message = $('#Message').val();
                var from = $('#From').val();
                console.log(to+' '+subject+' '+message+' '+from);

                $.ajax({
                    url : send_url,
                    type : 'post',
                    async : false,
                    data : {
                                'to' : to,
                                'subject' : subject,
                                'message' : message,
                                'from' : from
                            },
                    dataType : 'json',
                    success: function(data,status){
                      if(status)
                      {
                        if(data.error ==  0)
                        {
                            window.location.replace("<?=base_url()?>user/message/create");
                        }

                      }
                    },
                    error: function(xhr, desc, err){

                        console.log("Details: " + desc + "\nError:" + err);
                    }
                });

     });
});
</script>