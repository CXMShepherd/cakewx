<?php
	$this->extend('/Common/Admin/tab');
	
	// load css
	$this->Html->css(array(
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
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
	$this->start('tbtips');
	echo $this->element('Admin/tips', array('tips' => '移动应用的预览，请在添加完毕后点击编辑页面的“二维码”通选项卡生成二维码扫码进行预览。'), array('cache' => array('config' => "short")));
	$this->end('tbtips');
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
<?php $this->start('tbcontent'); ?>
<div id="home" class="tab-pane active">
	<h3 class="lighter block green">
		请完整填写应用基本信息：
	</h3>
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxWebchat', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "应用名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FIcon', array(
			'div' => "form-group", 
			'label' => array('text' => "应用logo（url）：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FMemo', array(
			'div' => "form-group", 
			'label' => array('text' => "应用简介：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
</div>
<div id="dp001" class="tab-pane">
	<h3 class="lighter block green">
		请配置微信应用的信息：
	</h3>
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('WxWebchat', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FWxopenId', array(
			'div' => "form-group", 
			'label' => array('text' => "公众号原始id：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle'><span class='maroon'>*</span>请认真填写，错了不能修改。比如：gh_270ef4b39b5b</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
		));
	echo $this->Main->formhr_input('FWxId', array(
			'div' => "form-group", 
			'label' => array('text' => "微信号：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-6'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FWxApi', array(
			'div' => "form-group", 
			'label' => array('text' => "接口地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'readonly' => TRUE,
			'placeholder' => $wxAPI, 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "</div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FWxToken', array(
			'div' => "form-group", 
			'readonly' => TRUE,
			'label' => array('text' => "TOKEN：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => $wxToken, 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "</div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));	
	?>
	<div class="alert alert-info" style="margin-top:20px">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<strong>
			提示：
		</strong>
		接口地址和TOKEN无须填写，请把这两个配置到微信公众平台，方才能正常工作。&nbsp;&nbsp;<font color="red">PS：<a target="_blank" style="color:red" href="http://www.cakewx.com/settings.html">微信公众平台具体怎么配置，传送门>></a></font>
		<br>
	</div>
</div>
<div id="dp002" class="tab-pane">
	<?php echo $this->element('Admin/tips', array('tips' => "二维码生成在新页面打开，直接保存就可以了。此外确保店招正常显示。"), array('cache' => array('config' => "short"))); ?>
	<button type='button' id='WX_code' class='btn btn-sm btn-success mar_5'><i class='icon-film'></i>生成二维码</button>
	<p class="hr16 iconCode"></p>
</div>
<?php echo $this->end(); ?>

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
echo $this->Form->hidden('WX_codeLogo', array('id' => "WX_codeLogo", 'value' => Router::url($data['list']['WxWebchat']['FIcon'], TRUE))); 
echo $this->Form->hidden('WX_codeUrl', array('id' => "WX_codeUrl", 'value' => Router::url('/', TRUE))); 
echo $this->Form->end();
?>
<?php echo $this->end(); ?>