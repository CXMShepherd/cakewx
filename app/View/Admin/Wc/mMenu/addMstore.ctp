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
        "Editor/kindeditor",
		"Action/webchat",
		"Action/twSelect"
	), array('block' => "script_extra", 'inline' => false));
?>
<?php echo $this->element('Admin/tips', array('tips' => "要添加店铺的栏目，请先创建一个店铺。"), array('cache' => array('config' => "short"))); ?>
<h3 class="lighter block blue">
微店铺的栏目：
</h3>
<h3 class="lighter block green">
&nbsp;&nbsp;&nbsp;&nbsp;请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataMenu', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FOwnerId', array(
		'div' => "form-group tpStore", 
		'options' => $data['stores'],
		'label' => array('text' => "选择一个店铺：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>（添加栏目，需要先选择店铺）</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FName', array(
		'div' => "form-group", 
		'label' => array('text' => "栏目名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FPicUrl', array(
		'div' => "form-group", 
		'label' => array('text' => "栏目图片：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button><span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FName', array(
		'div' => "form-group", 
		'label' => array('text' => "简介：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
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
        'after' => "<div class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FTwj', array(
		'div' => "form-group twjValue", 
		'label' => array('text' => "数据：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div><div class='col-xs-12 col-sm-9 no-padding-left'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>更换图文</button></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FFollowType', array(
		'div' => "form-group fHidden", 
		'options' => array('0' => "文本", '1' => "图文"),
		'label' => array('text' => "回复类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'selected' => "1",
		'placeholder' => "", 
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_hidden('FPreTwj', array('id' => "FPreTwj"));
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
<?php echo $this->Form->hidden('FType', array('id' => "FType", 'value' => "1")); ?>
<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataMenu")); ?>
<?php echo $this->Form->end(); ?>