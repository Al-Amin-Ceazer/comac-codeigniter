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
                    <div class="table-responsive">
                        <div class="btn-group">
                            <a data-toggle="dropdown" href="javascript:;" class="btn btn-sm blue dropdown-toggle" aria-expanded="false">
                            More <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a id="del_all"  vid="inbox" href="#">
                                    <i class="fa fa-trash-o"></i> Delete </a>
                                </li>
                            </ul>
                        </div>
                          <table class="table table-striped table-advance">
                                <thead>
                                      <tr>
                                            <th><input id="selecctall1" type="checkbox"></th>
                                            <th>Name</th>
                                            <th >Subject </th>
                                            <th > Message </th>
                                            <th >Date</th>
                                      </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($receive_message as $value) :
                                        if($value->read_status == 0) {
                                ?>
                                      <tr id="<?php echo $value->id ?>" >
                                            <td class="">
                                                <input name="checkbox[]" class="checkbox1" type="checkbox" id="checkbox[]" value="<?php echo $value->id ?>">
                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?=$value->id;?>/<?=$page?>'><b><?=$user_name[$value->from]?></b></td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?=$value->id;?>/<?=$page?>'><b>
                                                    <?php
                                                            $str = $value->subject;
                                                            if(strlen($str) > 20)
                                                             {
                                                                $fn = substr($str,0,20);
                                                                $fn .= "...";
                                                             }
                                                             else $fn = $str;

                                                            echo $fn;
                                                    ?>
                                                </b>
                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?= $value->id; ?>/<?=$page?>'><b>
                                                    <?php
                                                            $str = $value->message;
                                                            if(strlen($str) > 20)
                                                             {
                                                                $fn = substr($str,0,20);
                                                                $fn .= "...";
                                                             }
                                                             else $fn = $str;

                                                            echo $fn;
                                                    ?>
                                                </b>
                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?= $value->id; ?>/<?=$page?>'><b><?= $value->time;?></b></td>
                                      </tr>
                                <?php } else { ?>

                                        <tr id="<?php echo $value->id ?>" >
                                            <td class="">
                                                <input name="checkbox[]" class="checkbox1" type="checkbox" id="checkbox[]" value="<?php echo $value->id ?>">
                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?= $value->id;?>/<?=$page?>'><?=$user_name[$value->from]?></td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?= $value->id;?>/<?=$page?>'>
                                                    <?php
                                                            $str = $value->subject;
                                                            if(strlen($str) > 20)
                                                             {
                                                                $fn = substr($str,0,20);
                                                                $fn .= "...";
                                                             }
                                                             else $fn = $str;

                                                            echo $fn;
                                                    ?>

                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?=$value->id;?>/<?=$page?>'>
                                                    <?php
                                                            $str = $value->message;
                                                            if(strlen($str) > 20)
                                                             {
                                                                $fn = substr($str,0,20);
                                                                $fn .= "...";
                                                             }
                                                             else $fn = $str;

                                                            echo $fn;
                                                    ?>

                                            </td>
                                            <td class='clickable-row' data-href='<?= base_url()?>user/message/viewMessage_by_id/<?=$value->id;?>/<?=$page?>'><?= $value->time;?></td>
                                      </tr>

                                <?php } endforeach; ?>
                                </tbody>

                          </table>
                          <?php echo $links; ?>
                    </div>
            <!-- End Message Content -->

            </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
                resetcheckbox();
                $('#selecctall1').click(function(event) {  //on click
                    if ($(this).prop('checked')) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                             this.checked = true; //select all checkboxes with class "checkbox1"
                        });
                    } else {
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"
                        });
                    }
                });


                $("#del_all").on('click', function(e) {
                    e.preventDefault();

                     var checkValues = $('.checkbox1:checked').map(function()
                        {
                                return $(this).val();
                        }).get();
                     //console.log(checkValues);
                    if(checkValues.length > 0)
                    {
                        if(confirm("Are You Want To Delete?"))
                        {

                            $.ajax({
                                url: '<?= base_url()?>user/message/remove',
                                type: 'post',
                                data: 'ids=' + checkValues
                            }).done(function(data) {
                                //$("#respose").html(data);
                                $('#selecctall').attr('checked', false);
                            });

                            $.each( checkValues, function( i, val ) {
                                $("#"+val).remove();
                            });
                        }
                    }
                    else
                        alert("Please select an Item !");
                });

                function  resetcheckbox(){
                $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
                   });
                }
            });

    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });


</script>