<?php
	$this->extend('/Common/Admin/index');

	// load css
	$this->Html->css(array(
        // "Action/mPicAdd"
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));

	// load script
	$this->Html->script(array(
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataUser', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
echo $this->Main->formhr_input('FNickname', array(
		'div' => "form-group",
		'label' => array('text' => "昵称：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FSex', array(
		'div' => "form-group",
		'label' => array('text' => "性别：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FCity', array(
		'div' => "form-group",
		'label' => array('text' => "城市：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FullName', array(
		'div' => "form-group",
		'label' => array('text' => "真实姓名：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FPhone', array(
		'div' => "form-group",
		'label' => array('text' => "电话：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FSubscribe_time', array(
		'div' => "form-group",
		'label' => array('text' => "关注时间：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FCreatedate', array(
		'div' => "form-group",
		'label' => array('text' => "创建时间：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "text",
		'readonly' => true,
		'placeholder' => "",
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FMemo', array(
		'div' => "form-group",
		'label' => array('text' => "备注：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "textarea",
		'placeholder' => "",
		'class' => "col-xs-10 col-sm-5",
        'between' => "<div class='col-xs-12 col-sm-9'>",
        'after' => "<div class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>(备注此客户的真实姓名，联系电话，需求等)</span></div></div><div class='col-xs-12 col-sm-9'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>更换图文</button></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_hidden('FPreTwj', array('id' => "FPreTwj"));				// 隐藏域
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