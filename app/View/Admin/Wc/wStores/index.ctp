<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat",
		"Action/twPreview",
	), array('block' => "script_extra", 'inline' => false));
	// echo '<pre>';print_r($data['category']);exit;
	// echo $WC_query['value'];exit;
?>
<div style="margin-bottom:15px">
	<div class="btn-group">
		<button class="btn btn-sm btn-primary" onclick="location.href='<?= "{$WC_URL}?_a=add" ?>'">
			<i class="icon-pencil align-top bigger-125"></i>
			添加店铺
		</button>
		<button data-toggle="dropdown" class="btn btn-sm  btn-primary dropdown-toggle">
			<span class="icon-caret-down icon-only"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php echo $this->Html->link('普通店', "{$WC_URL}?_m=00&_a=add"); ?></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link('餐饮店', "{$WC_URL}?_m=cy001&_a=add"); ?></li>
			<li><?php echo $this->Html->link('果蔬店', "{$WC_URL}?_m=gs001&_a=add"); ?></li>
			<li><?php echo $this->Html->link('超市店', "{$WC_URL}?_m=cs001&_a=add"); ?></li>
		</ul>
	</div>
</div>
<div class="a_types">
    <ul class="ttp cl">
		<?php $css = ($WC_query['value'] == '') ? 'class="a"' : ''; ?>
        <li id="ttp_all" <?php echo $css; ?>><a href="<?php echo $WC_URL; ?>">全部</a></li>
		<?php foreach ($data['category'] as $key => $vals): ?>
			<?php $css = ($WC_query['value'] != '' && $WC_query['value'] == $vals['key']) ? 'class="a"' : ''; ?>
			 <?php echo "<li {$css}>"; ?>
				<a href="<?php echo $vals['link']; ?>"><?php echo $vals['name']; ?>
					<?php if ($vals['count']): ?>
						<span class="num"><?php echo $vals['count']; ?></span>
					<? endif ?>
				</a>
			</li>
		<? endforeach ?>
    </ul>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
                        <th>店铺名称</th>
						<th>店铺类型</th>
						<th>所属分类</th>
						<th>创建时间</th>
						<th>管理</th>
						<th>是否营业</th>
						<th>
							<i class="icon-time bigger-110 hidden-480"></i>
							操作
						</th>
					</tr>
				</thead>

				<tbody>
					<? if (is_array($data['datalist'])): ?>
						<? foreach ($data['datalist'] as $key => $vals): ?>
							<tr>
								<td>
									<?= $vals['WxDataStore']['FName'] ?>
								</td>
								<td>
                                   <?= $vals['WxDataStore']['C_FStore'] ?>
                                </td>
								<td>
                                   <?= $vals['WxDataStore']['C_FType'] ?>
                                </td>
								
								<td class="hidden-480">
									<p><?= $vals['WxDataStore']['FCreatedate'] ?></p>
								</td>
								<td>
									<p>
										<a href="<?php echo "{$WC_URL}?_m=cate&_id={$vals['WxDataStore']['Id']}" ?>" class="btn btn-success btn-xs">
											<i class="icon-shopping-cart"></i>
											商品分类
										</a>
										<a href="<?php echo "{$WC_URL}?_m=article&_id={$vals['WxDataStore']['Id']}" ?>" class="btn btn-warning btn-xs">
											<i class="icon-shopping-cart"></i>
											文章管理
										</a>
									</p>
								</td>
								<td>
									<p>
										<label style="margin-left:10px" class="inline">
											<small class="muted"></small>
											<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5">
											<span class="lbl"></span>
										</label>
									</p>
								</td>
								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

										<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo "{$WC_URL}?_a=edit&_id={$vals['WxDataStore']['Id']}" ?>'">
											<i class="icon-edit bigger-120" title="编辑"></i>
										</button>
										<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?php echo "{$WC_URL}?_a=del&_id={$vals['WxDataStore']['Id']}" ?>">
											<i class="icon-trash bigger-120" title="删除"></i>
										</button>
										<a class="btn btn-xs btn-warning" target="_blank" href="<?php echo "{$vals['WxDataStore']['fontendUrl']}"; ?>">
											<i class="icon-search bigger-120" title="查看"></i>
										</a>
									</div>
								</td>
							</tr>
						<? endforeach ?>
					<? endif ?>
				</tbody>
			</table>
			<ul class='pagination' style="margin-top:0">
				<?php 
					echo $this->Paginator->hasPrev() ? $this->Paginator->prev(
					  '« 上一页',
					  array('tag' => "li"),
					  null,
					  array('class' => 'disabled', 'tag' => "li", 'disabledTag' => "a")
					) : '';
					echo $this->Paginator->numbers(array('tag' => "li", 'separator' => "", 'currentClass' => "active", 'currentTag' => "a"));
				
					// Shows the next and previous links
					echo $this->Paginator->hasNext() ? $this->Paginator->next(
					  '下一页 »',
					  array('tag' => "li"),
					  null,
					  array('class' => 'disabled', 'tag' => "li", 'disabledTag' => "a")
					) : '';
				 ?>
			 </ul>
		</div><!-- /.table-responsive -->
	</div>
</div>