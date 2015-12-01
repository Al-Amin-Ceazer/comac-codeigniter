<div class="row">
    <div class="col-md-12">
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i>User List
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
                                <a class="btn green" href="<?= base_url()?>user/user/add">Add New <i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                <tr>
                    <th>
                         First Name
                    </th>
                    <th>
                         Last Name
                    </th>
                    <th>
                         Email Address
                    </th>
                    <th>
                         Type
                    </th>
                    <th>
                         Phone
                    </th>
                    <th>
                         Mobile
                    </th>
                    <th>
                         Position
                    </th>
                    <th>
                         Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($userList as $value):
                ?>
                <tr class="user-row">
                    <td><?= ucfirst($value->first_name);?></td>
                    <td><?= ucfirst($value->last_name);?></td>
                    <td><?= $value->email;?></td>
                    <td><?= ucfirst($value->type);?></td>
                    <td><?= $value->phone;?></td>
                    <td><?= $value->mobile;?></td>
                    <td><?= $value->position;?></td>
                    <td>
                        <a href="<?= base_url()?>user/user/edit/<?php echo $value->id;?>/<?=$page?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp;|
                        <a class="delete" href="<?= base_url()?>user/user/delete/"  id="<?= $value->id; ?>"><i class="fa fa-trash"></i></a>
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
