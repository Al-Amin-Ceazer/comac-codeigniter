<div class="row">
    <div class="col-md-12">
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cube"></i>Device List
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a class="btn green" href="<?= base_url()?>user/device/add">Add New <i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                <tr>
                    <th>
                         Brand
                    </th>
                    <th>
                         Model
                    </th>
                    <th>
                         Serial Number
                    </th>
                    <th>
                         IMEI Number
                    </th>
                    <th>
                         Sim Card
                    </th>
                    <th>
                         Voltage
                    </th>
                    <th>
                         Color
                    </th>
                    <th>
                         Material
                    </th>
                    <th>
                         Voice Activated
                    </th>
                    <th>
                         Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($deviceList as $value):
                ?>
                <tr class="user-row">
                    <td><?= ucfirst($brand_name[$value->brand_id]);?></td>
                    <td><?= ucfirst($model_name[$value->model_id]);?></td>
                    <td><?= $value->serial_number;?></td>
                    <td><?= $value->IMEI_number;?></td>
                    <td><?= ucfirst($sim_no[$value->sim_card]);?></td>
                    <td><?= $value->voltage;?></td>
                    <td><?= ucfirst($color_no[$value->color]);?></td>
                    <td><?= ucfirst($meterial_no[$value->meterial]);?></td>
                    <?php
                        if($value->voice_activated == 1) {
                    ?>
                    <td><?= YES; ?></td>
                    <?php
                    }
                        else  {
                    ?>
                    <td><?= NO;?></td>
                    <?php } ?>
                    <td>
                        <a href="<?= base_url()?>user/device/edit/<?php echo $value->id; ?>/<?=$page?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;|
                        <a class="delete" href="<?= base_url()?>user/device/delete/"  id="<?= $value->id; ?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                    endforeach;
                ?>
                </tbody>
                </table>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>

$(document).ready(function(){

        $(".delete").click(function(){
                            //alert("ok");
                     var url    = $(this).attr('href');
                     var del_id = $(this).attr('id');

                    //alert(url);
                    if(confirm("Are You Want To Delete?"))
                    {
                        $.ajax({
                                type     : "POST",
                                url       : url,
                                data    : {

                                    'del_id':del_id
                                },
                                success : function(){

                                }
                            });

                    $(this).parents(".user-row").animate({ backgroundColor: "#fff" }, "slow")
                    .animate({ opacity: "hide" }, "slow");
                    }

            return false;
    });

});

</script>
