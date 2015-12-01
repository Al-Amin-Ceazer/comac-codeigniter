<?php if($this->session->userdata('alert')):?>
	<div class="alert alert-block alert-<?= $this->session->userdata('alert-type')?>">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
	
		<i class="<?= $this->session->userdata('alert-type')=='success' ? 'icon-ok green' : 'icon-remove'?>"></i>
	
		<strong><?= $this->session->userdata('alert')?></strong>
	</div>
<?php endif; 
	$this->session->unset_userdata('alert');
	$this->session->unset_userdata('alert-type'); 
?>
<div id="notifyMsg"></div>
<div class="alert alert-block alert-success fade in" id="alert-success-div" style="display:none">
	<button data-dismiss="alert" class="close" type="button"></button>
		<h4 class="alert-heading">Success!</h4>
		<p id="alert-success-message">
			
		</p>
</div>