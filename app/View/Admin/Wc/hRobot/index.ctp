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
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxWcdata', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'options' => array('0' => "启用", '1' => "禁用"),
			'label' => array('text' => "是否启用：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "select", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'label' => array('text' => "启动关键字：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "客服", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'label' => array('text' => "使用内置词库：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'label' => array('text' => "自动退出（秒）：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'label' => array('text' => "进入欢迎语：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignText', array(
			'div' => "form-group", 
			'label' => array('text' => "退出结束语：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<button class="btn btn-info" type="submit">
				<i class="icon-ok bigger-110"></i>
				提交
			</button>
			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				重置
			</button>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
<?php $this->end(); ?>