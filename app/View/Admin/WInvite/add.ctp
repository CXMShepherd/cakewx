<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
		"Editor/kindeditor",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<style type="text/css">
	.mar_5 {
		margin: 0 0 0 10px;
	}
	.maroon {
		color: red;
		margin-right: 5px;
	}
	.form-group.error input, .form-group.error select, .form-group.error textarea {
		border-color: #f09784;
		color: #d68273;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.form-group.error .control-label, .form-group.error .help-block, .form-group.error .help-inline {
	color: #d16e6c;
	}
</style>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxInvite', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FInvCode', array(
		'div' => "form-group", 
		'label' => array('text' => "邀请码：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'readonly' => $action == 'edit' ? true : false,
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FMemo', array(
		'div' => "form-group", 
		'label' => array('text' => "备注：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle'><span class='maroon'></span></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
	));
if ($action == 'edit') {
	echo "<div class='form-group'><div class='col-xs-12 col-sm-9'><div class='clearfix'><p style='color:red' class='col-sm-3 control-label no-padding-right'>被邀请人详细信息：</p></div></div></div>";
	echo $this->Main->formhr_input('FullName', array(
		'div' => "form-group", 
		'label' => array('text' => "姓名：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle'><span class='maroon'></span></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
	));
	echo $this->Main->formhr_input('FMobileNumber', array(
		'div' => "form-group", 
		'label' => array('text' => "手机：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle'><span class='maroon'></span></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
	));
	echo $this->Main->formhr_input('FEMail', array(
		'div' => "form-group", 
		'label' => array('text' => "邮箱：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle'><span class='maroon'></span></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
	));
}
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