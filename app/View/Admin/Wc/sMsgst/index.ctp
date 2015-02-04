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
	<h3 class="lighter block green">
		微信消息群发：
	</h3>
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxDataSent', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 

	echo $this->Main->formhr_input('FType', array(
			'div' => "form-group", 
			'options' => array('0' => "文本", '1' => "图文"),
			'label' => array('text' => "发送类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "select", 
			'placeholder' => "", 
			'class' => "twSelect col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));

	echo $this->Main->formhr_input('FSentMsg', array(
			'div' => "form-group twjValue", 
			'label' => array('text' => "群发内容：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-5",
	        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	        'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>(发送内容，支持文字和图文)</span></span></div><div class='col-xs-12 col-sm-9 no-padding-left'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>更换图文</button></div></div>",
	        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
	<div class="alert alert-info" style="margin-top:20px">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<strong>
			提示：
		</strong>
		您这个月还可以发送4条消息。&nbsp;&nbsp;<font color="red">PS：请每次发送前认证检查要发送的内容，珍惜发送的机会。</font>
		<br>
	</div>
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				发送
			</button>
			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				重置
			</button>
		</div>
	</div>
	<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataSent")); ?>
	<?php echo $this->Form->end(); ?>
</div>
<?php $this->end(); ?>