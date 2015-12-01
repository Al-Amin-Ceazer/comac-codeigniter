<div class="col-md-10">

<div class="inbox-view-info">
    <div class="row">
        <div class="col-md-7">

            <span class="bold"><?=$user_name[$messageData->to]?></span>
            <span>
            &lt;support@go.com&gt; </span>

            on 08:20PM 29 JAN 2013
        </div>

        </div>
        </div>
        <div class="inbox-view">
            <div class="">
                <h4><b>Subject: <?= $messageData->subject;?></b></h4>
            </div>
            <p>
                <b><?= $messageData->message;?></b>
            </p>
        </div>
        <div class="">
            <a class="btn default" href="<?= base_url()?>user/message "  > Back</a>
        </div>
        </div>