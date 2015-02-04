<?php
	$this->extend('/Common/Admin/tab');
	
	// load css
	$this->Html->css(array(
        // "Action/mPicAdd"
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"Editor/kindeditor",
		"Action/webchat",
        "Action/twSelect"
	), array('block' => "script_extra", 'inline' => false));
	
	// Tab View
	$this->start('tab');
	echo $this->element('Admin/tab', array('nav' => $data['nav']), array('cache' => array('config' => "short")));
	$this->end();
	
	// Tips
	$this->start('tbtips');
	echo $this->element('Admin/tips', array('tips' => "此功能需要您的公众号通过微信认证，方才可正常使用。"), array('cache' => array('config' => "short")));
	$this->end('tbtips');
?>
<?php $this->start('tbcontent'); ?>
<div id="home" class="tab-pane active">
	<div class="row col-xs-12" style="margin-bottom:15px">
		<button class="btn btn-sm btn-primary"  onclick="location.href='<?= "{$WC_URL}?_a=add" ?>'">
			<i class="icon-pencil align-top bigger-125"></i>
			添加问答
		</button>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>问答标题</th>
							<th>回复内容</th>
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
									<td>
										<p><?= $this->Html->image($vals['WxWebchat']['FIcon'], array('fullBase' => true, 'width' => "88px", 'alt' => "")); ?></p>
										<p><?= $vals['WxWebchat']['FName'] ?></p>
									</td>
									<td>
										免费版
									</td>
									<td class="hidden-480">
										<p>创建时间:<?= $vals['WxWebchat']['FCreatedate'] ?></p>
										<p>到期时间:<?= $vals['WxWebchat']['FCreatedate'] ?></p>
									</td>
									<td>
										<p>请求数剩余：不限制</p>
									</td>

									<td class="hidden-480">
										<span class="label label-info label-success">
											永久可用
										</span>
									</td>

									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">

											<button class="btn btn-xs btn-info" onclick="parent.location.href='<?= Router::url(array('controller' => "admin", 'action' => "webchatEdit", $vals['WxWebchat']['Id'])) ?>'">
												<i class="icon-edit bigger-120"></i>
											</button>

											<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?= Router::url(array('controller' => "admin", 'action' => "webchatDel", $vals['WxWebchat']['Id'])) ?>">
												<i class="icon-trash bigger-120"></i>
											</button>

											<button class="btn btn-xs btn-warning" onclick="parent.location.href='<?= Router::url('/admin/wc/'.md5($vals['WxWebchat']['Id']).'/center'); ?>'">
												<i class="icon-wrench bigger-120"></i>
											</button>
										</div>
									</td>
								</tr>
							<? endforeach ?>
						<? endif ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
		</div>
	</div>
</div>
<?php $this->end(); ?>