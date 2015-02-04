<?php
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
        "Action/twSelect"
	), array('block' => "script_extra", 'inline' => false));
	
	// Tab View
	$this->start('tab');
	echo $this->element('Admin/tab', array('nav' => $data['nav']), array('cache' => array('config' => "short")));
	$this->end();
	
	// Tips
	$this->start('tbtips');
	echo $this->element('Admin/tips', array('tips' => "此功能需要您的公众号通过微信认证，方才可正常使用。"), array('cache' => array('config' => "short")));
	$this->end('tbtips');
?>
<?php $this->start('tbcontent'); ?>
<div id="home" class="tab-pane active">
	<div id="mch">
		这里是功能介绍。
	</div>
</div>
<?php $this->end(); ?>