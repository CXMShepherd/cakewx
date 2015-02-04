<?php if (isset($nav) && !empty($nav)): ?>
<div class="hr hr-dotted hr16"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs" id="myTab3">
				<?php if (is_array($nav)): ?>
					<?php foreach ($nav as $key => $vals): ?>
						<?php
							$view['active'] = isset($vals['default']) ? 'class="active"' : '';
							$view['uri'] = isset($key) ? "#{$key}" : '';
							$view['icon'] = isset($vals['icon']) ? "class=\"{$vals['icon']}\"" : 'blue bigger-110';
						?>
						<li <?php echo $view['active']; ?>>
							<a data-toggle="tab" href="<?php echo $view['uri']; ?>">
								<i <?php echo $view['icon']; ?>></i>
								<?php echo $vals['name']; ?>
							</a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
			<div class="tab-content">
				<?php echo empty($nav) ? '' : $this->fetch('leftTabContent'); ?>
			</div>
		</div>
	</div>
</div>
<? endif ?>