<?php
	$view['store'] = $WC_query['mod'] ? $WC_query['mod'] : '00';
	$this->extend('/Common/Admin/tab');
	
	// load css
	$this->Html->css(array(
        // "Action/mPicAdd"
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"Action/mCate",
		"Editor/kindeditor",
		"Editor/lang/zh_CN",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
	
	// Tab View
	$this->start('tab');
	echo $this->element('Admin/tab', array('nav' => $data['nav']), array('cache' => array('config' => "short")));
	$this->end();
	
	// Tab Header
	$this->start('tbheader');
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxDataStore', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
	$this->end();
	
	// Tips
	if (isset($data['WxDataStore']['Id'])) {
		$this->start('tbtips');
		echo $this->element('Admin/tips', array('tips' => '店铺的首页地址：'.$this->Html->link("{$data['WxDataStore']['fontendUrl']}", $data['WxDataStore']['fontendUrl'], array('target' => "_blank"))), array('cache' => array('config' => "short")));
		$this->end('tbtips');
	}
	
	//print_r($data['WxDataStore']['FBackPicUrl']);exit;
?>
<?php $this->start('tbheader'); ?>
<h3 class="lighter block blue">
<?php echo $action == 'add' ? "创建一个{$data['tips_store']}：" : "编辑店铺：{$data['WxDataStore']['FName']}"; ?>
</h3>
<?php $this->end(); ?>
<!-- tb_content -->
<?php $this->start('tbcontent'); ?>
<div id="home" class="tab-pane active">
	<h3 class="lighter block green">
		请填写以基本信息：
	</h3>
	<?php 
	echo $this->Main->formhr_input('FOwnerId', array(
			'div' => "form-group", 
			'options' => $data['cates'],
			'label' => array('text' => "店铺分类：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "select", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignPicUrl', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺标志（url）：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FMemo', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺简介：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FQQ', array(
			'div' => "form-group", 
			'label' => array('text' => "QQ：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FPhone', array(
			'div' => "form-group", 
			'label' => array('text' => "联系电话：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAddress', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAdLng', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺经度：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAdLat', array(
			'div' => "form-group", 
			'label' => array('text' => "店铺纬度：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FOrderPrefix', array(
			'div' => "form-group", 
			'label' => array('text' => "订单前缀：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
</div>
<div id="dp001" class="tab-pane">
	<?php
		echo $this->Main->formhr_input('FStatus', array(
				'div' => "form-group", 
				'options' => array('1' => "正常营业", '0' => "暂停营业"),
				'label' => array('text' => "营业状态：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "select", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FOrderTime', array(
				'div' => "form-group", 
				'label' => array('text' => "营业时间：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "早9:00-晚8:00", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FStopMemo', array(
				'div' => "form-group", 
				'label' => array('text' => "暂停营业的提示语：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "textarea", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FSendPrice', array(
				'div' => "form-group", 
				'label' => array('text' => "起送价格：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FDevCost', array(
				'div' => "form-group", 
				'label' => array('text' => "外送费：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FOvFreeDc', array(
				'div' => "form-group", 
				'label' => array('text' => "免外送费的订单总额：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "100", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FDevDistance', array(
				'div' => "form-group", 
				'label' => array('text' => "外送距离：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FDevArea', array(
				'div' => "form-group", 
				'label' => array('text' => "外送区域：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
	?>
</div>
<div id="dp002" class="tab-pane">
	<?php
		echo $this->Main->formhr_input('FPay', array(
				'div' => "form-group", 
				'options' => array('0' => "货到付款", '1' => "在线支付", '2' => "微信支付"),
				'label' => array('text' => "", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "select", 
				'placeholder' => "", 
				'multiple' => 'checkbox',
				'class' => "col-xs-10 hr6",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "</div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
				'hiddenField' => FALSE,
				'disabled' => array('1', '2'),
				'selected' => 0
			));
	?>
</div>
<div id="dp003" class="tab-pane">
	<?php
		echo $this->Main->formhr_input('FIsDrLimit', array(
				'div' => "form-group", 
				'options' => array('0' => "关闭", '1' => "启用"),
				'label' => array('text' => "是否开启配送时间限制：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "select", 
				'placeholder' => "", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
		echo $this->Main->formhr_input('FDrTime', array(
				'div' => "form-group", 
				'label' => array('text' => "最少提前多少分钟下单：", 'class' => "col-sm-3 control-label no-padding-right"), 
				'type' => "text", 
				'placeholder' => "30", 
				'class' => "col-xs-10 col-sm-5",
				'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
				'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>分钟</span></span></div></div>",
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
			));
	?>
</div>
<div id="dp004" class="tab-pane">
	<?php
		echo $this->Main->formhr_checkbox('FIsCouponsFirst', array(
			'div' => "form-group", 
			'label' => array('text' => "启用首单优惠", 'class' => "col-sm-3 control-label no-padding-right"), 
			'placeholder' => "", 
			'class' => "hr6",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='middle maroon'></span></div></div>",
		));
		echo $this->Main->formhr_input('FCouponsFirst', array(
			'div' => "form-group", 
			'label' => array('text' => "首单立减多少：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "5", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>元</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
		echo $this->Main->formhr_checkbox('FIsCoupons', array(
			'div' => "form-group", 
			'label' => array('text' => "启用优惠券", 'class' => "col-sm-3 control-label no-padding-right"), 
			'placeholder' => "", 
			'class' => "hr6",
			'disabled' => TRUE,
			'hiddenField' => FALSE,
			'checked' => FALSE,
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='middle maroon'></span></div></div>",
		));
		echo $this->Main->formhr_input('FMcouponPrice', array(
			'div' => "form-group", 
			'label' => array('text' => "优惠券最大面值：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'disabled' => TRUE,
			'placeholder' => "30", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>元</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
		echo $this->Main->formhr_checkbox('FIsDiscount', array(
			'div' => "form-group", 
			'label' => array('text' => "启用会员打折", 'class' => "col-sm-3 control-label no-padding-right"), 
			'placeholder' => "", 
			'class' => "hr6",
			'hiddenField' => FALSE,
			'disabled' => TRUE,
			'selected' => 0,
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='middle maroon'></span></div></div>",
		));
		echo $this->Main->formhr_input('FDiscount', array(
			'div' => "form-group", 
			'label' => array('text' => "会员折扣值：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "10", 
			'disabled' => TRUE,
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
</div>
<div id="dp005" class="tab-pane">
	<?php
		echo $this->Main->formhr_checkbox('FIsRdPhone', array(
			'div' => "form-group", 
			'label' => array('text' => "短信订单提醒", 'class' => "col-sm-3 control-label no-padding-right"), 
			'placeholder' => "", 
			'class' => "hr6",
			'hiddenField' => FALSE,
			'checked' => TRUE,
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='middle maroon'></span></div></div>",
		));
		echo $this->Main->formhr_input('FRdPhone', array(
			'div' => "form-group", 
			'label' => array('text' => "接收短信手机号码：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
		echo $this->Main->formhr_checkbox('FIsRdMail', array(
			'div' => "form-group", 
			'label' => array('text' => "邮箱订单提醒", 'class' => "col-sm-3 control-label no-padding-right"), 
			'placeholder' => "", 
			'class' => "hr6",
			'hiddenField' => FALSE,
			'selected' => 0,
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='middle maroon'></span></div></div>",
		));
		echo $this->Main->formhr_input('FRdMail', array(
			'div' => "form-group", 
			'label' => array('text' => "接收订单Email地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
</div>
<div id="dp006" class="tab-pane">
	<?php 
		echo $this->element('Admin/tips', array('tips' => "图片最大允许上传500K,支持jpg、png、jpeg格式的图片,为了达到最佳效果，建议上传640*320的图片。"), array('cache' => array('config' => "short"))); 
		echo $this->Form->hidden('FBackPicUrl', array('class' => "iconText")); 
	?>
	<button type='button' id='WX_img' class='btn btn-sm btn-success mar_5'><i class='icon-camera'></i>上传图片</button>
	<p class="hr16" style="margin-left:10px;">当前店铺图片(最多1张)</p>
	<div class="iconPreview hr16" style="margin-left:10px;">
		<?php if ($data['WxDataStore']['FBackPicUrl']): ?>
			<img src="<?php echo Router::url($data['WxDataStore']['FBackPicUrl'], TRUE); ?>" width='320' />
		<? endif ?>
	</div>
</div>
<div id="dp007" class="tab-pane">
	<?php echo $this->element('Admin/tips', array('tips' => "二维码生成在新页面打开，直接保存就可以了。此外确保店招正常显示。"), array('cache' => array('config' => "short"))); ?>
	<button type='button' id='WX_code' class='btn btn-sm btn-success mar_5'><i class='icon-film'></i>生成二维码</button>
	<p class="hr16 iconCode"></p>
</div>
<div id="dp008" class="tab-pane">
	dp001
</div>
<?php $this->end(); ?>

<!-- tb_footer -->
<?php $this->start('tbfooter'); ?>
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
<?php 
echo $this->Form->hidden('WX_codeLogo', array('id' => "WX_codeLogo", 'value' => Router::url($data['WxDataStore']['FSignPicUrl'], TRUE))); 
echo $this->Form->hidden('WX_codeUrl', array('id' => "WX_codeUrl", 'value' => $data['WxDataStore']['fontendUrl'])); 
echo $this->Form->hidden('FStore', array('id' => "FStore", 'value' => $view['store'])); 
echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataKds"));
echo $this->Form->end();
$this->end();
?>