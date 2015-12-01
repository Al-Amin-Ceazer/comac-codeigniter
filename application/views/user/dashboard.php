				<!-- BEGIN DASHBOARD STATS -->
				<div class="row">
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light red-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-cog"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?=$device_count?>
							</div>
							<div class="desc">
								 Total Devices
							</div>
						</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light blue-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-group"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?=$user_count?>
							</div>
							<div class="desc">
								 My Users
							</div>
						</div>
						</a>
					</div>

					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light purple-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?=$message_count?>
							</div>
							<div class="desc">
								 My Messages
							</div>
						</div>
						</a>
					</div>
				</div>
				<!-- END DASHBOARD STATS -->
				<div class="clearfix">
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN PORTLET-->
						<div class="portlet box purple">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="fa fa-cog"></i>My Latest Devices
				                </div>
				            </div>
				            <div class="portlet-body">
				                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				                <thead>
				                <tr>
				                    <th>
				                         Device Id
				                    </th>
				                    <th>
				                         Date
				                    </th>
				                    <th>
				                         Status
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
				                    <td><?= $value->serial_number;?></td>
				                    <td>2015-09-31</td>
				                    <?php
				                    		if($value->voice_activated == 1) {
				                    ?>
				                    <td><?= Active;?></td>
				                    <?php }
				                    else {
				                    ?>
				                    <td><?= Inactive;?></td>
				                    <?php
				                    		}
				                	?>
				                    <td><a class="btn default btn-sm green-stripe" href="<?= base_url()?>user/device/view/<?= $value->id; ?>">View</a></td>
				                </tr>
				            <?php endforeach; ?>
				                </tbody>
				                </table>
				            </div>
	        			</div>
						<!-- END PORTLET-->
					</div>
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN PORTLET-->
						<div class="portlet box purple">
				            <div class="portlet-title">
				                <div class="caption">
				                    <i class="fa fa-envelope"></i>My Messages
				                </div>
				            </div>
				            <div class="portlet-body">
				                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				                <thead>
				                <tr>
				                    <th>
				                         Sender
				                    </th>
				                    <th>
				                         Date & Time
				                    </th>
				                    <th>
				                         Status
				                    </th>
				                    <th>
				                         Action
				                    </th>

				                </tr>
				                </thead>
				                <tbody>
				                <?php
				                    foreach ($receive_message as $value) :
				                ?>
				                <tr class="user-row">
				                    <td><?=$user_name[$value->from]?></td>
				                    <td><?=date("h:ia jS M Y",strtotime($value->time));?></td>
				                    <?php
				                    	if($value->read_status == 0) {
				                    ?>
				                    <td><b><?= Unread;?></b></td>
				                    <?php } else { ?>
				                    <td><?= Read;?></td>
				                    <?php }?>
				                    <td><a class="btn default btn-sm green-stripe" href="<?= base_url()?>user/dashboard/viewMessage_by_id/<?= $value->id; ?>">View</a></td>
				                </tr>
				                <?php
				                    endforeach;
				                ?>
				                </tbody>
				                </table>
				            </div>
	        			</div>
						<!-- END PORTLET-->
					</div>
				</div>


				<div class="clearfix">
				</div>