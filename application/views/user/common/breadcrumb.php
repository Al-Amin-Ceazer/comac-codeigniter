<?php
	$breadcrumbs = array(
						'dashboard' => array( 'user/dashboard' => 'Dashboard' ),
						'user/add_user'  => array('user/user'=>'Users','user/user/add' => 'Add User'),
						'userList' => array( 'user/user' => 'Users' ),
						'message' => array( 'user/message' => 'Message' ),
						'message/create' => array('user/message' => 'Message', 'user/message/create' => 'Compose'),
						'message/inbox' => array('user/message' => 'Message', 'user/message/inbox' => 'Inbox'),
						'message/sent' => array('user/message' => 'Message', 'user/message/sentbox' => 'Sent Box'),
						"user/edit" => array('user/user' => 'Users' , 'user/user/edit' => 'Edit User'),
						'company' => array( 'user/company' => 'Company List' ),
						'company/add_company' => array( 'user/company' => 'Company', 'user/company/add' => 'Add Company'),
						'company/edit' => array( 'user/company' => 'Company', 'user/company/edit' => 'Edit Company'),
						'user/profile' => array( 'user/profile' => 'Profile'),
						'device' => array( 'user/device' => 'Device'),
						'device/add_device' => array( 'user/device' => 'Device', 'user/device/add' => 'Add Device'),
						'device/edit' => array( 'user/device' => 'Device', 'user/device/edit' => 'Edit Device'),
						'device/view' => array( 'user/device' => 'Device', 'user/device/view' => 'View Device'),
						'sim_card' => array( 'user/sim_card' => 'Sim Card'),
						'sim/add_sim' => array( 'user/sim_card' => 'Sim Card', 'user/sim_card/add' => 'Add Sim Card'),
						'sim/edit' => array( 'user/sim_card' => 'Sim Card', 'user/sim_card/edit' => 'Edit Sim Card'),
						'model' => array( 'user/model' => 'Models'),
						'model/add_model' => array('user/model' => 'Models', 'user/model/add' => 'Add Model'),
						'model/edit' => array('user/model' => 'Models', 'user/model/edit' => 'Edit Model')
					);

	$breadcrumb = $breadcrumbs[$breadcrumb];
	//d($breadcrumb);
?>

<div class="page-bar" id="breadcrumbs">
<ul class="page-breadcrumb">
	<li>
		<i class="fa fa-home"></i>
		<a href="<?= site_url('user/dashboard')?>">Home</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<?php if(is_array($breadcrumb)){
		$ind = 0;
		$cnt = count($breadcrumb);
			foreach($breadcrumb as $key=>$val){
			 $ind++;
			 if($ind != $cnt)
				echo '<li><a href="'. site_url($key) .'">'. $val .'</a> <i class="fa fa-angle-right"></i></li>';
			 else
			 	echo '<li>'. $val .'</li>';
			}
		}
	?>
</ul><!-- .breadcrumb -->

</div>