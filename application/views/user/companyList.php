<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-rocket"></i>Company List
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse">
            </a>
            <a href="#portlet-config" data-toggle="modal" class="config">
            </a>
            <a href="javascript:;" class="reload">
            </a>
            <a href="javascript:;" class="remove">
            </a>
        </div>
    </div>

    <div class="portlet-body">
        <div class="table-toolbar">
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        <a class="btn green" href="<?= base_url()?>user/company/add">Add New <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>
                 Company Name
            </th>
            <th>
                 Address
            </th>
            <th>
                 City
            </th>
            <th>
                 State
            </th>
            <th>
                 Country
            </th>
            <th>
                 Web Site
            </th>
            <th>
                 Logo
            </th>
            <th>
                 Action
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($companyAll as $value):
        ?>
        <tr class="company">
            <td><?= $value->name; ?></td>
            <td><?= $value->address; ?></td>
            <td><?= $value->city; ?></td>
            <td><?= $value->state; ?></td>
            <td><?= $value->country; ?></td>
            <td><?= $value->web_site; ?></td>
            <td><img src="<?= base_url()."assets/uploads/images/company_logo/thumb/".$value->logo;?>" style="width: 60px; height: 60px;" alt="Company Logo"></td>
            <td>
                <a class="label label-info" href="<?= base_url()?>user/company/edit/<?= $value->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>&nbsp;|
                <a class="delete label label-danger" href="<?= base_url()?>user/company/delete/"  id="<?= $value->id; ?>"><i class="fa fa-trash"></i></a>
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

                    $(this).parents(".company").animate({ backgroundColor: "#fff" }, "slow")
                    .animate({ opacity: "hide" }, "slow");
                    }

            return false;
    });

});

</script>