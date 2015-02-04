<!-- sidebar -->
<?php $this->start('sidebar'); ?>
	<? foreach ($vmenu['menu'] as $key => $vals): ?>
		<?
		 	$toggle = isset($vals['child']) ? TRUE : FALSE; 
			$active = isset($vals['active']) ? TRUE : FALSE;
			$view['toggle'] = $toggle ? 'class="dropdown-toggle"' : '';
			$view['down'] = $toggle ? '<b class="arrow icon-angle-down"></b>' : '';
			$view['avop'] = $active && $toggle ? 'class="active open"' : ($active ? 'class="active"' : '');
		?>
		<li <?= $view['avop'] ?>>
			<a href="<?= $vals['url'] ?>" <?= $view['toggle'] ?>>
				<i class="<?= $vals['icon'] ?>"></i>
				<span class="menu-text"><?= $key ?></span>
				<?= $view['down'] ?>
			</a>
			<? if ($toggle): ?>
				<ul class="submenu">
					<? foreach ($vals['child'] as $k => $v): ?>
						<?
							$c_active = isset($v['active']) ? TRUE : FALSE;
							$view['cavop'] = $c_active ? 'class="active"' : '';
						?>
						<li <?= $view['cavop'] ?>>
							<a href="<?= $v['url'] ?>">
								<i class="<?= $v['icon'] ?>"></i>
								<?= $k ?>
							</a>
						</li>
					<? endforeach ?>
				</ul>
			<? endif ?>
		</li>
	<? endforeach ?>
<?php $this->end(); ?>
<a class="menu-toggler" id="menu-toggler" href="#">
	<span class="menu-text"></span>
</a>
<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<!-- <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					<button class="btn btn-success">
						<i class="icon-signal"></i>
					</button>

					<button class="btn btn-info">
						<i class="icon-pencil"></i>
					</button>

					<button class="btn btn-warning">
						<i class="icon-group"></i>
					</button>

					<button class="btn btn-danger">
						<i class="icon-cogs"></i>
					</button>
				</div> -->
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>
			<span class="btn btn-info"></span>
			<span class="btn btn-warning"></span>
			<span class="btn btn-danger"></span>
		</div>
	</div><!-- #sidebar-shortcuts -->
	<ul class="nav nav-list">
		<?= $this->fetch('sidebar'); ?>
	</ul><!-- /.nav-list -->
	<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
	</div>
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>