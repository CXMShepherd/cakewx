<?php
	$view['baseurl'] = $data['baseurl'];
	$this->extend('/Common/Admin/tab');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat",
		"Action/twPreview",
	), array('block' => "script_extra", 'inline' => false));
	// echo '<pre>';print_r($data['category']);exit;
	// print_r($WC_query);exit;
	
	// Tab View
	$this->start('tab');
	echo $this->element('Admin/tab', array('nav' => $data['nav']), array('cache' => array('config' => "short")));
	$this->end();
?>
<?php $this->start('tbheader'); ?>
<h3 class="lighter block blue">
<?php echo $data['storeList']['WxDataPlace']['FName']; ?>：
</h3>
<?php $this->end(); ?>
<?php $this->start('tbcontent'); ?>
<div id="dp001" class="tab-pane active">
	<div style="margin-bottom:15px">
		<div class="btn-group">
			<button class="btn btn-sm btn-primary" onclick="location.href='<?= "{$view['baseurl']}&_a=add" ?>'">
				<i class="icon-pencil align-top bigger-125"></i>
				添加商家
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
	                        <th>商家名称</th>
							<th>地址</th>
							<th>营业时间</th>
							<th>排序</th>
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
										<?= $vals['WxDataPlStore']['FName'] ?>
									</td>
									<td><?= $vals['WxDataPlStore']['FAddress'] ?></td>
									<td><?= $vals['WxDataPlStore']['FOrderTime'] ?></td>
									<td><?= $vals['WxDataPlStore']['FOrder'] ?></td>
									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo "{$view['baseurl']}&_a=edit&_cid={$vals['WxDataPlStore']['Id']}" ?>'">
												<i class="icon-edit bigger-120" title="编辑"></i>
											</button>
											<button class="btn btn-xs btn-danger bootbox-confirm" onclick="parent.location.href='<?php echo "{$view['baseurl']}&_a=del&_cid={$vals['WxDataPlStore']['Id']}" ?>'">
												<i class="icon-trash bigger-120" title="删除"></i>
											</button>
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
</div>
<?php $this->end(); ?>