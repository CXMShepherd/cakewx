<?php
	$view['baseurl'] = $data['baseurl'];
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
		"Editor/lang/zh_CN",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
	
	// Tab View
	$this->start('tab');
	echo $this->element('Admin/tab', array('nav' => $data['nav']), array('cache' => array('config' => "short")));
	$this->end();
?>
<?php $this->start('tbheader'); ?>
<h3 class="lighter block blue">
<?php echo $data['storeList']['WxDataPlace']['FName']; ?>：
</h3>
<?php $this->end(); ?>
<?php $this->start('tbcontent'); ?>
<div id="dp001" class="tab-pane active">
	<h3 class="lighter block green">
	&nbsp;&nbsp;&nbsp;&nbsp;请完整填写以下信息：
	</h3>
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxDataPlStore', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "商家名称：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAddress', array(
			'div' => "form-group", 
			'label' => array('text' => "地址：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FOrderTime', array(
			'div' => "form-group", 
			'label' => array('text' => "营业时间：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "早9:00－晚8:00",
			'class' => "col-xs-10 col-sm-5",
	        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	        'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
	        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FPicUrl', array(
			'div' => "form-group", 
			'label' => array('text' => "商家Logo：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-5",
	        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	        'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
	        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FCategory', array(
			'div' => "form-group", 
			'label' => array('text' => "分类：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-5",
	        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	        'after' => "</div></div>",
	        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FTopSign', array(
			'div' => "form-group", 
			'label' => array('text' => "标签：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'placeholder' => "推荐/火爆/促销", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAdTile', array(
			'div' => "form-group", 
			'label' => array('text' => "广告标题：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FMemo', array(
			'div' => "form-group", 
			'label' => array('text' => "简介：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FOrder', array(
			'div' => "form-group", 
			'label' => array('text' => "排序：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-5",
	        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	        'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
	        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FLinkUrl', array(
		'div' => "form-group", 
		'label' => array('text' => "链接地址：", 'class' => "col-sm-2 control-label no-padding-right"),
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-5'><span class='middle maroon'>（可选，如果开放了店铺功能可以链接过去）</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_input('FIsTop', array(
    	'div' => "form-group",
		'options' => array('0' => '是否热门', '1' => '是否推荐(会显示到首页)', '2' => "是否在线订购"),
	    'label' => array('text' => "置顶：", 'class' => "col-sm-2 control-label no-padding-right"),
	    'type' => "select",
		'multiple' => "checkbox",
	    'placeholder' => "",
	    'class' => "col-xs-10 col-sm-12",
	    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
	    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
	    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
    ));
	?>
	<div class="clearfix form-actions">
		<div class="col-sm-3 no-padding-right">
			<button class="btn btn-grey" type="button" onclick="location.href='<?php echo $view['baseurl']; ?>'">
                <i class="icon-arrow-left bigger-110"></i>
                返回
            </button>
		</div>
		<div class="col-xs-12 col-sm-9">
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
	<?php echo $this->Form->hidden('FOwnerId', array('id' => "FOwnerId", 'value' => $data['storeList']['WxDataPlace']['Id'])); ?>
	<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataCate")); ?>
	<?php echo $this->Form->end(); ?>
</div>
<?php $this->end(); ?>
