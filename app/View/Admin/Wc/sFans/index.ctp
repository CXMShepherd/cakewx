<?php
	$this->extend('/Common/Admin/index');

	// load script
	$this->Html->script(array(
		"/assets/js/bootbox.min",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<style type="text/css">
.userlist img, p {
	float: left;
}
.userlist p {
	margin: 3px 0 0 10px;
	font-size: 14px/21px;
	font-weight: bold;
	color: #666;
}
.page_counter span {
	margin-left: 10px !important;
	border: none !important;
}
</style>
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<strong>
		提示：
	</strong>
    此功能需要您的公众号通过微信认证，方才可正常使用。
	<br>
</div>
<div class="row col-xs-12" style="margin-bottom:15px">
	<button class="btn btn-sm btn-primary"  onclick="location.href='<?= "{$WC_URL}?_a=sync" ?>'">
		<i class="icon-download-alt align-top bigger-125"></i>
		同步粉丝数据
	</button>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>头像</th>
						<th>性别</th>
						<th>城市</th>
						<th>所在省</th>
						<th>国家</th>
						<th>真实姓名</th>
						<th>手机</th>
						<th>已报名</th>
						<th>关注时间</th>
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
								<td class="userlist">
									<?= $this->Html->image($vals['WxDataUser']['Headimgurl_96'], array('fullBase' => true, 'width' => "64px", 'alt' => "")); ?>
									<p><?= $vals['WxDataUser']['FNickname'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FSex'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FCity'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FProvince'] ?></p>

								</td>
								<td>
									<p><?= $vals['WxDataUser']['FCountry'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FullName'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FPhone'] ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FIsMember'] ? '是' : '否' ?></p>
								</td>
								<td>
									<p><?= $vals['WxDataUser']['FSubscribe_time'] ?></p>
								</td>
								<td>
									<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

										<button class="btn btn-xs btn-info" onclick="parent.location.href='<?= "{$WC_URL}?_a=edit&_id={$vals['WxDataUser']['FOpenId']}" ?>'">
											<i class="icon-edit bigger-120"></i>
										</button>

										<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?= "{$WC_URL}?_a=del&_id={$vals['WxDataUser']['FOpenId']}" ?>">
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
					echo $this->Paginator->counter('{:count}') ? "<li class='page_counter'><span>".$this->Paginator->counter(
					    '总计：{:count} 个粉丝'
					)."</span></li>" : '';
				 ?>
			 </ul>
		</div><!-- /.table-responsive -->
	</div>
</div>