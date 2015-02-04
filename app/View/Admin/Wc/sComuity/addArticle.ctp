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
		"Action/webchat",
		"Action/addware"
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
	echo $this->Form->create('WxDataCate', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
	echo $this->Main->formhr_input('FStore', array(
			'div' => "form-group tpStore fHidden", 
			'options' => array('0' => "商铺", '1' => "商品"),
			'label' => array('text' => "商铺：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "select", 
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group", 
			'label' => array('text' => "分类名称：", 'class' => "col-sm-2 control-label no-padding-right"),
			'type' => "text", 
			'readonly' => true,
			'placeholder' => "", 
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_hidden('FPreTwj', array('id' => "FPreTwj"));
	?>
    <div class="form-group twjValue">
        <label for="WxDataCateFProduct" class="col-sm-2 control-label no-padding-right">商品：</label>
        <div class="col-xs-12 col-sm-9">
            <div class="u-chooses waresbox"></div>
            <button type="button" id="addTw" style="">选择商品</button>
        </div>
    </div>
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
	<?php echo $this->Form->hidden('LN_options', array('id' => "LN_options", 'value' => "({'text': { 'addText': '添加商品', 'selectText': '选择商品', 'changeText': '添加商品' }, 'simple': 0})")); ?>
	<?php echo $this->Form->hidden('FType', array('id' => "FType", 'value' => "4")); ?>
	<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataCate")); ?>
	<?php echo $this->Form->end(); ?>
</div>
<?php $this->end(); ?>
