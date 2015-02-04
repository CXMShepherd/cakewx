<?php
 	$view['store'] = $WC_query['mod'] ? $WC_query['mod'] : '0';
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
	echo $this->Form->create('WxDataPlace', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
	$this->end();
	
	// Tips
	if (isset($data['WxDataPlace']['Id'])) {
		$this->start('tbtips');
		echo $this->element('Admin/tips', array('tips' => '社区的首页地址：'.$this->Html->link("{$data['WxDataPlace']['fontendUrl']}", $data['WxDataPlace']['fontendUrl'], array('target' => "_blank"))), array('cache' => array('config' => "short")));
		$this->end('tbtips');
	}
?>
<?php $this->start('tbheader'); ?>
<h3 class="lighter block blue">
<?php echo $action == 'add' ? "创建一个社区（{$data['tips_store']}）：" : "编辑社区：{$data['WxDataPlace']['FName']}"; ?>
</h3>
<?php $this->end(); ?>
<!-- tb_content -->
<?php $this->start('tbcontent'); ?>
<div id="home" class="tab-pane active">
	<h3 class="lighter block green">
		请填写以基本信息：
	</h3>
	<?php 
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "社区名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FSignPicUrl', array(
			'div' => "form-group", 
			'label' => array('text' => "社区标志（url）：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FMemo', array(
			'div' => "form-group", 
			'label' => array('text' => "社区简介：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FQqQun', array(
			'div' => "form-group", 
			'label' => array('text' => "QQ群：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FWxQun', array(
			'div' => "form-group", 
			'label' => array('text' => "微信群：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<button type='button' id='WX_iconSec' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAddress', array(
			'div' => "form-group", 
			'label' => array('text' => "社区地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FCompanyName', array(
			'div' => "form-group", 
			'label' => array('text' => "物业公司：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FPhone', array(
			'div' => "form-group", 
			'label' => array('text' => "物业电话：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FWyAddress', array(
			'div' => "form-group", 
			'label' => array('text' => "物业地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAdLng', array(
			'div' => "form-group", 
			'label' => array('text' => "社区经度：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "text", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FAdLat', array(
			'div' => "form-group", 
			'label' => array('text' => "社区纬度：", 'class' => "col-sm-3 control-label no-padding-right"), 
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
		echo $this->element('Admin/tips', array('tips' => "最多允许上传3张图，图片最大允许上传500K,支持jpg、png、jpeg格式的图片,为了达到最佳效果，建议上传640*240的图片。"), array('cache' => array('config' => "short"))); 
		echo $this->Form->hidden('WxDataPlace.FBackPicUrl.0', array('class' => "iconText")); 
		echo $this->Form->hidden('WxDataPlace.FBackPicUrl.1', array('class' => "iconText")); 
		echo $this->Form->hidden('WxDataPlace.FBackPicUrl.2', array('class' => "iconText")); 
	?>
	<button type='button' id='WX_selectMultiImage' class=' btn btn-sm btn-success mar_5'><i class='icon-camera'></i>上传图片</button>
	<p class="hr16" style="margin-left:10px;">当前社区图片(最多3张)</p>
	<p id="WX_imageView" class="hr16">
		<?php if ($data['WxDataPlace']['FBackPicUrl']): ?>
			<?php foreach ($data['WxDataPlace']['FBackPicUrl'] as $key => $vals): ?>
				<img src="<?php echo Router::url($vals, TRUE); ?>" width='320' height="120" />
			<? endforeach ?>
		<? endif ?>
	</p>
</div>
<div id="dp002" class="tab-pane">
	<?php echo $this->element('Admin/tips', array('tips' => "二维码生成在新页面打开，直接保存就可以了，此外确保社区的标志图正常显示。"), array('cache' => array('config' => "short"))); ?>
	<button type='button' id='WX_code' class='btn btn-sm btn-success mar_5'><i class='icon-film'></i>生成二维码</button>
	<p class="hr16 iconCode"></p>
</div>
<div id="dp003" class="tab-pane">
	<?php
	echo $this->Main->formhr_input('FPlPhone', array(
			'div' => "form-group bmdh", 
			'label' => array('text' => "便民电话：", 'class' => "col-sm-3 control-label no-padding-right"), 
			'type' => "textarea", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-8'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
	<p>帮助：一行一个电话信息，比如：物业服务中心电话,010-80367161|80367181-200</p>
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
echo $this->Form->hidden('WX_codeLogo', array('id' => "WX_codeLogo", 'value' => Router::url($data['WxDataPlace']['FSignPicUrl'], TRUE))); 
echo $this->Form->hidden('WX_codeUrl', array('id' => "WX_codeUrl", 'value' => $data['WxDataPlace']['fontendUrl'])); 
echo $this->Form->hidden('FType', array('id' => "FType", 'value' => $view['store'])); 
echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataPlace"));
echo $this->Form->end();
$this->end();
?>