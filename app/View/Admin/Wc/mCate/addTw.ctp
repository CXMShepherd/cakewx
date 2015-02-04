<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
        // "Action/mPicAdd"
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"Action/mCate"
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block blue">
图文分类：
</h3>
<h3 class="lighter block green">
&nbsp;&nbsp;&nbsp;&nbsp;请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataCate', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FName', array(
		'div' => "form-group", 
		'label' => array('text' => "分类名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FOrder', array(
		'div' => "form-group", 
		'label' => array('text' => "排序：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
        'between' => "<div class='col-xs-12 col-sm-9'>",
        'after' => "<div class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></div></div><div class='col-xs-12 col-sm-9'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>更换图文</button></div>",
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
<?php echo $this->Form->hidden('FType', array('id' => "FType", 'value' => "0")); ?>
<?php echo $this->Form->end(); ?>