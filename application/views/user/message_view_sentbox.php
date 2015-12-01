 <div class="portlet light">
    <div class="portlet-body">

                    <div id="tab_1_4" class="tab-pane inbox">
                            <!--    <div class="col-md-10 " style="padding-top:20px;">-->
                                <div class="inbox-header">
                                    <h1 class="pull-left">View Message</h1>
                                </div>
                                <div class="inbox-loading" style="display: none;">
                                     Loading...
                                </div>
                                <div class="inbox-content"><div class="inbox-header inbox-view-header">
                                    <h1 class="pull-left"><span id="message_header"><?= $messageData->subject;?></span> <a href="javascript:;" id='view-from'>
                                    Outbox </a>
                                    </h1>
                                    <div class="pull-right">
                                        <i class="fa fa-print"></i>
                                    </div>
                                </div>
                                <div class="inbox-view-info">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <img id='profile_image' style="width:30px;" src="<?= $profile_image;?>">
                                            <span class="bold" id="sender_name">
                                            <?= $sender_name;?></span>
                                            &lt;<span id="sender_email">
                                            <?= $sender_email;?> </span>&gt;
                                            to <span class="bold" id="recever_name">
                                            <?= $recever_name;?> </span>
                                            on <span id="send_time"><?= $send_time;?></span>
                                        </div>
                                        <div class="col-md-5 inbox-info-btn">
                                            <div class="btn-group">
                                                <!--<button class="btn blue reply-btn" data-messageid="23">
                                                <i class="fa fa-reply"></i> Reply </button>
                                                <button data-toggle="dropdown" class="btn blue dropdown-toggle">
                                                <i class="fa fa-angle-down"></i>
                                                </button>-->
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a class="reply-btn" data-messageid="23" href="javascript:;">
                                                        <i class="fa fa-reply reply-btn"></i> Reply </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        <i class="fa fa-arrow-right reply-btn"></i> Forward </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        <i class="fa fa-print"></i> Print </a>
                                                    </li>
                                                    <li class="divider">
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        <i class="fa fa-ban"></i> Spam </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        <i class="fa fa-trash-o"></i> Delete </a>
                                                    </li>
                                                    <li>
                                                    </li></ul></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inbox-view" id="message">
                                                <?= $messageData->message;?>
                                        </div>
                                        <hr>
                                        <div class="inbox-attached" id="attachment">
                                                <a class="btn default" href="<?= base_url()?>user/message/sentbox/<?=$page?>">Back</a>
                                        </div></div>
                        <!--    </div>-->
                    </div>
    </div>
</div>
