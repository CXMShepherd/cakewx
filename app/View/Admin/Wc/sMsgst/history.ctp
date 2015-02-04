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
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table id="sample-table-1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
	                        <th>名称</th>
							<th>类型</th>
							<th>状态</th>
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
										<?php echo $vals['WxDataSent']['FType'] == 1 ? $this->Html->image($vals['WxDataSent']['FSentMsg']['PicUrl'], array('fullBase' => true, 'width' => "160px", 'alt' => "")) : ''; ?>
										<p><?php echo $vals['WxDataSent']['FType'] == 1 ? $this->Html->link($vals['WxDataSent']['C_Text'], $vals['WxDataSent']['FSentMsg']['Url'], array('target' => '_blank')) : $vals['WxDataSent']['C_Text'] ?></p>
									</td>
									<td>
	                                   <?= $vals['WxDataSent']['C_FType'] ?>
	                                </td>
									<td>
	                                   <?= $vals['WxDataSent']['C_FStatus'] ?>
	                                </td>
									<td class="hidden-480">
										<p><?= $vals['WxDataSent']['FCreatedate'] ?></p>
									</td>
									<td>
										<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
											<button class="btn btn-xs btn-danger bootbox-confirm" alt="<?php echo "{$WC_URL}?_m=history&_a=del&_id={$vals['WxDataSent']['Id']}" ?>">
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