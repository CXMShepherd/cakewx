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
	
	$data['datalist'] = !$data['datalist'] ? array(
		0 => array('WxDataCate' => array('Id' => string::uuid(), 'FName' => "公告")),
	) : $data['datalist'];
?>
<?php $this->start('tbheader'); ?>
<h3 class="lighter block blue">
<?php echo $data['storeList']['WxDataStore']['FName']; ?>：art
</h3>
<?php $this->end(); ?>
<?php $this->start('tbcontent'); ?>
<div id="dp001" class="tab-pane active">
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
	                        <th>文章分类</th>
							<th>所属栏目</th>
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
										<?= $vals['WxDataCate']['FName'] ?>
									</td>
									<td><?= $vals['WxDataCate']['FOwnerName'] ? $vals['WxDataCate']['FOwnerName'] : '应用首页' ?></td>
									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo "{$view['baseurl']}&_a=edit&_cid={$vals['WxDataCate']['Id']}" ?>'">
												<i class="icon-edit bigger-120" title="编辑"></i>
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