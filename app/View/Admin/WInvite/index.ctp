<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<button style="margin-bottom:15px" class="btn btn-sm btn-primary"  onclick="location.href='<?= Router::url(array('controller' => "admin", 'action' => "wInvite", "add")) ?>'">
	<i class="icon-plus align-top bigger-125"></i>
	添加邀请码
</button>

<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover account">
				<thead>
					<tr>
						<th style="text-align:center;">
							序号
						</th>
						<th style="text-align:center;">
							邀请码
						</th>
						<th>生成时间</th>
						<th class="hidden-480">
							备注
						</th>
						<th class="hidden-480">
							是否使用
						</th>
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
								<td style="text-align:center;">
									<?= $vals['WxInvite']['FNumberId'] ?>
								</td>
								<td style="text-align:center;">
									<?= $vals['WxInvite']['FInvCode'] ?>
								</td>
								<td>
									<?= $vals['WxInvite']['FCreatedate'] ?>
								</td>
								<td>
									<?= $vals['WxInvite']['FMemo'] ?>
								</td>
								<td class="hidden-480">
									<?= $vals['WxInvite']['C_FIsUsed'] ?>
								</td>
								<td class="wc_actions">
									<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo Router::url(array('controller' => "admin", 'action' => "wInvite", "edit", $vals['WxInvite']['Id'])) ?>'">
										<i class="icon-edit bigger-120"></i>
									</button>

									<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?php echo Router::url(array('controller' => "admin", 'action' => "wInvite", "del", $vals['WxInvite']['Id'])) ?>">
										<i class="icon-trash bigger-120"></i>
									</button>
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