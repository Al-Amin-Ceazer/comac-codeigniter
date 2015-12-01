<div class="row">
    <div class="col-md-12">
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-desktop"></i>Model List
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
                                <a class="btn green" href="<?= base_url()?>user/model/add">Add New <i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                <tr>
                    <th>
                         Brand name
                    </th>
                    <th>
                         Model name
                    </th>
                    <th>
                         Colors
                    </th>
                    <th>
                         Material
                    </th>
                    <th>
                         Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($modelList as $value):
                ?>
                <tr class="user-row">
                    <td><?= ucfirst($brand_name[$value[brand_id]]);?></td>
                    <td><?= $value[model_name];?></td>
                    <td><?= $value[color];?></td>
                    <td><?= $value[meterial];?></td>
                    <td>
                        <a href="<?= base_url()?>user/model/edit/<?php echo $value[id]; ?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;|
                        <a class="delete" href="<?= base_url()?>user/model/delete/"  id="<?= $value[id]; ?>"><i class="fa fa-trash"></i></a>
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