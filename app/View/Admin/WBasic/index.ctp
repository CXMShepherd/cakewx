<?php
	$this->extend('/Common/Admin/index');
?>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('Site', array('role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('Site.title', array(
		'div' => "form-group", 
		'label' => array('text' => "站点名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('Site.name', array(
		'div' => "form-group", 
		'label' => array('text' => "站点标语：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('Site.keywords', array(
		'div' => "form-group", 
		'label' => array('text' => "Meta关键字：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('Site.description', array(
		'div' => "form-group", 
		'label' => array('text' => "Meta描述：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('Site.description', array(
		'div' => "form-group", 
		'label' => array('text' => "Meta描述：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('Site.FSiteStats', array(
	'div' => "form-group",
    'label' => array('text' => "统计代码：", 'class' => "col-sm-3 control-label no-padding-right"),
    'type' => "textarea",
	'multiple' => "checkbox",
    'placeholder' => "",
    'class' => "col-xs-10 col-sm-12",
    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
    'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
));
echo $this->Main->formhr_input('Site.FOpenSignup', array(
	'div' => "form-group",
	'options' => array('0' => "关闭注册", '1' => '开放注册', '2' => "邀请注册"),
    'label' => array('text' => "网站状态：", 'class' => "col-sm-3 control-label no-padding-right"),
    'type' => "select",
	'multiple' => "checkbox",
    'placeholder' => "",
    'class' => "col-xs-10 col-sm-12",
    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
    'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
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