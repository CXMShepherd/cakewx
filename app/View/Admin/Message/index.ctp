<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"Action/message"
	), array('block' => "script_extra", 'inline' => false));
	echo $this->element('Admin/tips', array('tips' => '短信账号需要付费，如需要请加入CakeWX交流群：5169425 向群主获取。'), array('cache' => array('config' => "short")));
?>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('TPerson', array('role' => "form", 'class' => "form-horizontal", 'autocomplete' => "off")); 
echo $this->Main->formhr_input('FPhoneUser', array(
		'div' => "form-group", 
		'label' => array('text' => "短信账号：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "请输入短信账号", 
		'autocomplete' => 'off',
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FPhonePwd', array(
		'div' => "form-group", 
		'label' => array('text' => "密码：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "请输入短信密码", 
		'autocomplete' => 'off',
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo "<div class='form-group'><div class='col-xs-12 col-sm-9'><div class='clearfix'><p style='color:red' class='col-sm-3 control-label no-padding-right'>短信测试：</p></div></div></div>";
echo $this->Main->formhr_input('WX.FPhoneNumber', array(
	'div' => "form-group", 
	'label' => array('text' => "手机短信测试：", 'class' => "col-sm-3 control-label no-padding-right"), 
	'placeholder' => "请输入测试手机号", 
	'autocomplete' => FALSE,
	'class' => "col-xs-10 col-sm-5",
	'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>".'<button id="phoneMessage" class="btn btn-xs" type="button">短信测试</button>'."</span></span></div></div>",
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
		&nbsp; &nbsp; &nbsp;
		
	</div>
</div>
<?php echo $this->Form->end(); ?>