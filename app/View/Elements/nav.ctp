<!-- Header Area -->
<div class="header">
	<!-- Navigation Menu -->
	<div class="navbar navbar-fixed-top" role="navigation"  style="padding-right:160px;">
		<a id="footer" href="#signup-block">免费注册</a>
		<div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#home">
                    <!-- Logo Text -->
                    <h1><?php echo $this->Html->image('/html/img/douya.png', array('style' => "margin-left:10px")); ?></h1>
                </a>
            </div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#home">首页</a></li>
					<li><a href="#service">产品特性</a></li>
                    <li><a href="#moshi">运营模式</a></li>
                    <!--<li><a href="#baojia">报价方案</a></li>-->
					<li><a href="#examples">客户案例</a></li>
					<li><a href="#shiyong">联系我们</a></li>
					<li><?php echo $this->Html->link('登录', array('controller' => "user", 'action' => "login")); ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Navigation End -->
</div>
<!-- Header End -->