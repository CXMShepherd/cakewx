<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<div class="row col-xs-12" style="margin-bottom:15px">
	<button class="btn btn-sm btn-primary"  onclick="location.href='<?php echo Router::url(array('controller' => "admin", 'action' => "pUsers", "add")) ?>'">
		<i class="icon-pencil align-top bigger-125"></i>
		添加新用户
	</button>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th style="text-align:center">序号</th>
						<th>用户名</th>
						<th>姓名</th>
						<th>邮箱</th>
						<th>电话</th>
						<th>城市</th>
						<th>创建时间</th>
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
								<td style="text-align:center"> 
									<p><?php echo $vals['TPerson']['FNumberId']; ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FMemberId'] ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FullName'] ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FEMail'] ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FMobileNumber'] ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FCity'] ?></p>
								</td>
								<td>
									<p><?= $vals['TPerson']['FCreatedate'] ?></p>
								</td>

								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

										<button class="btn btn-xs btn-info" onclick="parent.location.href='<?php echo Router::url(array('controller' => "admin", 'action' => "pUsers", "edit", $vals['TPerson']['Id'])) ?>'">
											<i class="icon-edit bigger-120"></i>
										</button>

										<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?php echo Router::url(array('controller' => "admin", 'action' => "pUsers", "del", $vals['TPerson']['Id'])) ?>">
											<i class="icon-trash bigger-120"></i>
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