<?php echo $this->element('Admin/nav', array(), array('cache' => array('config' => "short"))); ?>
<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	<div class="main-container-inner">
		<?= $this->element('Admin/sidebar'); ?>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				<ul class="breadcrumb">
					<li>
						<i class="icon-home home-icon"></i>
						<a href="#">首页</a>
					</li>
					<li class="active"><?= $this->Main->MY_currmenu($vmenu['search'], TRUE); ?></li>
				</ul><!-- .breadcrumb -->
				<div class="nav-search" id="nav-search">
					<form class="form-search">
						<span class="input-icon" style="display:none">
							<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
							<i class="icon-search nav-search-icon"></i>
						</span>
					</form>
				</div><!-- #nav-search -->
			</div>
			<div class="page-content">
				<div class="page-header">
					<h1>
						<?= $this->Main->MY_currmenu($vmenu['search']); ?>
					</h1>
				</div><!-- /.page-header -->
				<div class="col-sm-12">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div><!-- /.page-content -->
			<?php echo $this->element('Admin/settings'); ?>

		</div>
	</div><!-- /.main-container-inner -->
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="icon-double-angle-up icon-only bigger-110"></i>
	</a>
</div>
<div class="mtm copyright text-center">©2014 <?php echo $version; ?></div>
<!-- /.main-container
</div><!-- /.main-container -->