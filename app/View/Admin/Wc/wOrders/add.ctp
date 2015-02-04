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
<h3 class="lighter block green">
&nbsp;&nbsp;&nbsp;&nbsp;请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('123', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('C_StoreName', array(
		'div' => "form-group", 
		'label' => array('text' => "所属店铺：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'value' => $data['WxDataOrder']['C_StoreName'],
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('C_Order', array(
		'div' => "form-group", 
		'label' => array('text' => "订单号：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'value' => $data['WxDataOrder']['C_Order'],
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('FPrice', array(
		'div' => "form-group", 
		'label' => array('text' => "订单总价：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'value' => "¥{$data['WxDataOrder']['FPrice']}",
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('FCreatedate', array(
		'div' => "form-group", 
		'label' => array('text' => "创建时间：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'value' => $data['WxDataOrder']['FCreatedate'],
		'readonly' => true,
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('WxDataOrder.FIsTop', array(
    	'div' => "form-group",
		'options' => array('0' => '无效订单', '2' => '确认订单'),
	    'label' => array('text' => "操作：", 'class' => "col-sm-3 control-label no-padding-right"),
	    'type' => "select",
		'multiple' => "checkbox",
	    'placeholder' => "",
	    'class' => "col-xs-10 col-sm-12",
	    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
	    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
    ));
	echo "<div class='form-group'><div class='col-xs-12 col-sm-9'><div class='clearfix'><p style='color:red' class='col-sm-3 control-label no-padding-right'>订购人信息：</p></div></div></div>";
	echo $this->Main->formhr_input('WxDataOrder.FUserName', array(
    	'div' => "form-group",
	    'label' => array('text' => "姓名：", 'class' => "col-sm-3 control-label no-padding-right"),
	    'type' => "text",
	    'placeholder' => "",
		'readonly' => true,
	    'class' => "col-xs-10 col-sm-12",
	    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
	    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
    ));
	echo $this->Main->formhr_input('WxDataOrder.FUserPhone', array(
    	'div' => "form-group",
	    'label' => array('text' => "电话：", 'class' => "col-sm-3 control-label no-padding-right"),
	    'type' => "text",
		'readonly' => true,
	    'placeholder' => "",
	    'class' => "col-xs-10 col-sm-12",
	    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
	    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
    ));
	echo $this->Main->formhr_input('WxDataOrder.FUserAddress', array(
    	'div' => "form-group",
	    'label' => array('text' => "地址：", 'class' => "col-sm-3 control-label no-padding-right"),
	    'type' => "text",
		'readonly' => true,
	    'placeholder' => "",
	    'class' => "col-xs-10 col-sm-12",
	    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
	    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
    ));
	echo "<div class='form-group'><div class='col-xs-12 col-sm-9'><div class='clearfix'><p style='color:red' class='col-sm-3 control-label no-padding-right'>购买商品详细信息：</p></div></div></div>";
	if (is_array($data['WxDataOrder']['FProduct'])) {
		foreach ($data['WxDataOrder']['FProduct'] as $key => $vals) {
			echo $this->Main->formhr_input('FProduct', array(
				'div' => "form-group", 
				'label' => array('text' => $vals['title']."：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'readonly' => true,
				'value' => "¥{$vals['price']} / {$vals['unit']} X {$vals['count']}",
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		}
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
<?php echo $this->Form->hidden('FType', array('id' => "FType", 'value' => "2")); ?>
<?php echo $this->Form->end(); ?>