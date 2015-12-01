<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<?php $type = $this->session->userdata('type');?>
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li <?= $menu == 'dashboard' ? ' class="start active"' : ''?> >
						<a href="<?=base_url('user/dashboard')?>">
						<i class="fa fa-dashboard"></i>
						<span class="title">Dashboard</span>
						<span <?= $menu == 'dashboard' ? ' class="selected "' : 'class="arrow "'?>></span>
						</a>
					</li>

					<?php if($type != 'user'):?>
					<li <?= $menu == 'users' ? ' class="start active"' : ''?>>
						<a href="<?=base_url('user/user')?>">
						<i class="fa fa-group"></i>
						<span class="title">Users</span>
						<span <?= $menu == 'users' ? ' class="selected "' : 'class="arrow "'?>></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?=base_url('user/user')?>">
								User List</a>
							</li>
							<li>
								<a href="<?=base_url('user/user/add')?>">
								Add User</a>
							</li>
						</ul>
					</li>
					<?php endif;?>

					<li <?= $menu == 'devices' ? ' class="start active"' : ''?>>
						<a href="<?=base_url('user/device')?>">
						<i class="fa fa-cube"></i>
						<span class="title">Devices</span>
						<span <?= $menu == 'devices' ? ' class="selected "' : 'class="arrow "'?>></span>
						</a>
					</li>

					<?php if($type == 'superadmin'):?>
					<li <?= $menu == 'models' ? ' class="start active"' : ''?> >
						<a href="<?=base_url('user/model')?>">
						<i class="fa fa-cubes"></i>
						<span class="title">Models</span>
						<span <?= $menu == 'models' ? ' class="selected "' : 'class="arrow "'?> ></span>
						</a>
					</li>
					<?php endif;?>

					<li <?= $menu == 'message' ? ' class="start active"' : ''?>>
						<a href="<?=base_url('user/message')?>">
						<i class="fa fa-envelope"></i>
						<span class="title">Messages</span>
						<span <?= $menu == 'message' ? ' class="selected "' : 'class="arrow "'?>></span>
						</a>
					</li>

					<?php if($type == 'superadmin'):?>
					<li <?= $menu == 'company' ? ' class="start active"' : ''?> >
						<a href="<?=base_url('user/company')?>">
						<i class="fa fa-university"></i>
						<span class="title">Companies</span>
						<span <?= $menu == 'company' ? ' class="selected "' : 'class="arrow "'?> ></span>
						</a>
					</li>
					<?php endif;?>

					<?php if($type == 'superadmin'):?>
					<li <?= $menu == 'sim_card' ? ' class="start active"' : ''?> >
						<a href="<?=base_url('user/sim_card')?>">
						<i class="fa fa-phone-square"></i>
						<span class="title">Sim Card</span>
						<span <?= $menu == 'sim_card' ? ' class="selected "' : 'class="arrow "'?> ></span>
						</a>
					</li>
					<?php endif;?>

					<li <?= $menu == 'profile' ? ' class="start active"' : ''?>>
						<a href="<?=base_url('user/profile')?>">
						<i class="fa fa-user"></i>
						<span class="title">Profile</span>
						<span <?= $menu == 'profile' ? ' class="selected "' : 'class="arrow "'?> ></span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->