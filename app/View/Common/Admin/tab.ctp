<?php 
$this->extend('/Common/Admin/index');
?>
<?php echo $this->fetch('tbtips'); ?>
<?php echo $this->fetch('tbheader'); ?>
<div class="col-sm-12">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
			<?php echo $this->fetch('tab'); ?>
		</ul>
		<div class="tab-content">
			<?php echo $this->fetch('tbcontent'); ?>
		</div>
		<?php echo $this->fetch('tbfooter'); ?>
	</div>
</div>
