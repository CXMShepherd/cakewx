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
		"Action/mPicAdd"
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block green" style="margin-bottom: 25px">
	请选择要添加栏目的类型：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
?>
<div class="row">
	<div class="col-sm-12">
		<div class="well">
			<h4 class="blue smaller lighter"><?php echo $this->Html->link('微官网的栏目', "{$WC_URL}?_m=mSite&_a=add"); ?></h4>
			发布文章类型的单图文展示页面，普通文章，适用公司简介，联系方式等信息的展示。
		</div>
		<div class="well">
			<h4 class="blue smaller lighter"><?php echo $this->Html->link('微店铺的栏目', "{$WC_URL}?_m=mStore&_a=add"); ?></h4>
			发布活动类型的单图文，活动详细页展示您定义的活动，有刮刮卡，大转盘，优惠券，及活动报名，成员审核，活动管理等。
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>