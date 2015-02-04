<?php
	// nav
	$this->start('nav');
	echo $this->element('nav');
	$this->end();
?>
<!-- Wrapper -->
<div class="wrapper">
	<?= $this->fetch('nav'); ?>
	<!-- For navigation -->
	<section id="home">
		<div class="tp-banner-container">
			<div class="tp-banner">
				<ul>
					<li data-transition="slidedown" data-slotamount="1">
					   <?php echo $this->Html->image('/html/img/transparent.png'); ?>
					   <!-- Heading -->
					   <div class="caption tp-caption sft large_bold_white" data-x="center" data-y="60" data-start="1700" data-easing="easeOutBack">微社区，超赞的社区移动O2O服务平台。</div>
					   <div class="caption tp-caption sft custom_para text-center"  data-x="center" data-y="115" data-speed="500" data-start="2100" data-easing="easeOutBack">
                           豆芽为您创建一个低成本，高效，多元化O2O社区（智慧小区，地方社区，企业社区，校友社区，俱乐部等）生态圈。
						</div>
						<!-- Image -->
						<div class="caption sfb" data-x="center" data-y="166" data-speed="1000" data-start="3200" data-easing="easeOutBack">
							<?php echo $this->Html->image('/html/img/preview_wxq.png', array('width' => "960", 'alt' => "豆芽后台管理界面", 'class' => "img-responsive")); ?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<div class="ann" style="text-align:center;line-height: 40px;color:#f00;background: #FFF;">官方QQ交流群：295169425 <span style="color:#888;margin-left:10px;">推荐使用Chrome，safari，Firefox火狐浏览器浏览器，获得最佳使用体验。</span></div>
	<!--<p style="margin-top:10px; text-align:center;"></p>-->
	<!-- Main Content -->
	<div class="main-content bgwhite">
		<!-- For navigation -->
		<section id="service" class="bdt">
            <div class="expd clearfix">
                <div class="col-md-6 col-sm-6 txt-center preimg">
                    <?php echo $this->Html->image('/html/img/xq.png'); ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div  style="width: 460px;">
                    <h3>微小区移动服务平台</h3>
                    <p>微小区为物业打造专属功能，可以轻松发布小区公告、办事指南等，业主还可豆芽端进行自助报修、意见反馈。充分降低物业管理成本，从而提高物业服务水平，帮助物业企业全面进入“微物业”时代。</p>
                    </div>
                </div>
            </div>
            <div id="service1" class="bdt">
                <div class="portfolio-content expd clearfix">
                    <div class="col-md-6 col-sm-6">
                        <div  style="width: 460px;margin:0 auto">
                            <h3>小区商户电子商务平台</h3>
                            <p>主要为小区内商户提供电子商务O2O平台，小区商户可方便快速的建立自己的网络销售平台，提一条龙式的移动平台，网店商铺介绍，打折优惠信息，店铺详细地址，在线购物，交流平台，在给小区居民提供遍历服务的同时也给物业， 本地商铺带来新的盈利模式。</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 txt-center">
                        <?php echo $this->Html->image('/html/img/dp.png'); ?>
                    </div>
                </div>
            </div>

            <div id="service2" class="bdt">
                <div class="portfolio-content expd clearfix">
                    <div class="col-md-6 col-sm-6 txt-center">
                        <?php echo $this->Html->image('/html/img/wsq.png'); ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div  style="width: 460px;margin:0 auto">
                            <h3>小区交流互动平台</h3>
                            <p>邻里互助帮帮忙，二手闲置物品近距离交易，兴趣小组开心聊。专为小区内居民提供便利的移动端交流平台，打造一个极具用户粘性的本地社区服务，生活平台。</p>
                        </div>
                    </div>
                </div>
            </div>
		</section>

        <section id="moshi" class="expd bdt">
            <div class="portfolio-content">
                <?php echo $this->Html->image('/html/img/moshi.png', array('alt' => "微小区运营模式")); ?>
            </div>
        </section>
        <section id="baojia" style="display:none" class="expd bdt">
            <div class="container">
                <div class="heading text-center">
                    <h5 style="font-size: 40px;">
                    	报价方案
                    </h5>
                    <div class="bor"></div>
                </div>
                <div class="col-md-6 col-sm-6 txt-center">
                    <div class="info-item">
                        <i class="fa fa-group" style="font-size: 60px;color:#00CC00;"></i>
                        <h4 class="txt-center">微小区 <span style="font-size: 24px;margin-left: 10px;color:#00CC00">299</span>/年<span style="font-size:14px">（个人版）</span></h4>
						<p class="txt-center">
							<span style="font-size:14px">（公众号数量限1个）</span><br />
							<span style="color: red">主要功能：</span><br />
							自动回复<br />
							图文回复<br />
							素材库（不限）<br />
							自定义菜单<br />
							微会员<br />
							微小区<br />
						</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 txt-center">
                    <div class="info-item">
                        <i class="fa fa-cutlery" style="font-size: 60px;color:#99CC33;"></i>
                        <h4 class="txt-center">微店铺 <span style="font-size: 24px;margin-left: 10px;color:#99CC33">5000</span>/年<span style="font-size:14px">（商家版）</span></h4>
						<span style="font-size:14px">（公众号数量限1个，可以创建10个分店）</span><br />
						<p class="txt-center">
							<span style="color: red">主要功能：</span><br />
							自动回复<br />
							图文回复<br />
							素材库（不限）<br />
							自定义菜单<br />
							微会员<br />
							微店铺<br />
						</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="examples" class="expd bdt">
            <div class="container">
                <div class="heading text-center">
                    <h5>客户案例</h5>
                    <div class="bor"></div><br />
                </div>
                <div class="col-md-3 col-sm-3 txt-center">
                    <?php echo $this->Html->image('/html/img/wxq.jpg', array('width' => "200", 'alt' => "微小区公众号")); ?>
                    <h2>长阳半岛小区</h2>
                </div>
                <div class="col-md-3 col-sm-3 txt-center">
                    <?php echo $this->Html->image('/html/img/wsh.jpg', array('width' => "200", 'alt' => "微小区公众号")); ?>
                    <h2>第五食堂</h2>
                </div>
				<div class="col-md-3 col-sm-3 txt-center">
                    <?php echo $this->Html->image('/html/img/hfxq.jpg', array('width' => "200", 'alt' => "微小区公众号")); ?>
                    <h2>华府西畦果蔬驿站</h2>
                </div>
				<div class="col-md-3 col-sm-3 txt-center">
                    <?php echo $this->Html->image('/html/img/doudou.jpg', array('width' => "200", 'alt' => "微小区公众号")); ?>
                    <h2>豆豆便利店</h2>
                </div>
            </div>
        </section>
        <section id="contact" style="display:none" class="expd bdt">
            <div class="container">
                <div class="heading text-center">
                    <h2>联系方式</h2>
                    <div class="bor"></div>
                    <p>专业的技术团队，为您提供完美的技术解决方案。</p>
                </div>
            </div>
            <div class="container">
                <!-- Info Area -->
                <div class="contact-info">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="info-item">
                                <!-- Icon -->
                                <i class="fa fa-map-marker"></i>
                                <h4>地址</h4>
                                <p>北京市东城区南竹杆胡同2号银河SOHO，5层20616-A0382</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="info-item">
                                <i class="fa fa-envelope-o"></i>
                                <h4>邮箱</h4>
                                <p>liunianbook@gmail.com</p>
                            </div>
                        </div>
                        <div class="clearfix visible-xs"></div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="info-item">
                                <!-- Icon -->
                                <i class="fa fa-print"></i>
                                <h4>电话</h4>
                                <p>13301372150</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="info-item">
                                <i class="fa fa-calendar"></i>
                                <h4>时间</h4>
                                <p>早：9:00 - 晚：18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- For navigation -->
		<section id="shiyong" class="bdt">
			<div class="contact expd">
				<div class="container">
					<!-- Contact Contents -->
					<div class="contact-content">
						<!-- Heading -->
						<h5 class="text-center">意见反馈</h5>
						<div class="bor"></div>
						<br />
						<!-- Contact Form -->
						<form role="form" id="contactForm" method="post">
                                <div class="row">
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" class="form-control" name="FName" id="name" placeholder="您的姓名" value="" required>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<input type="email" class="form-control" id="email" name="FEMail" placeholder="邮件地址" value="" required>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<input type="text" class="form-control" id="phone" name="FPhone" placeholder="您的电话" value="">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<textarea class="form-control" name="FMessage" id="message" rows="6" placeholder="写写您的需求吧，需要试用什么产品。"></textarea>
									</div> 
									<button type="submit" id="submit" name="submit" class="btn btn-theme">发送</button>
								</div>
							</div>
						</form>
						
						<!-- Alertbox for success -->
						<div id="success" class="alert alert-success alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>谢谢!</strong> 我们将在收到留言后及时回复您。
						</div>
						
						<!-- Alertbox for failure -->
						<div id="error" class="alert alert-danger alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <strong>错误！</strong> 无法发送您的信息. 
						</div>									
						
					</div>
				</div>	
			</div>
		</section>
	</div>
	<!-- Main Content End -->
	<!-- Footer start -->
	<section id="about">
		<div class="cta">
			<div class="footer clearfix">
				<div style="float:left;margin:60px 20px 20px 0;width:350px;">
	            	<img src="http://s01.liunian.mobi/cakewx/web/erwm.png" width="100px" height="100px" style="float:left;margin-right:10px;">
	                <p>微信扫码左侧二维码<br>关注豆芽官方微信公众号<br>关注豆芽最新产品动态</p>
	            </div>
				<div class="span6 col-form" id="signup-block">
                    <form role="form" class="simple_form form form-stacked email-signup-form" id="regForm" method="post">
			          	<fieldset>
				            <div class="control-group">
				              <label class="string required control-label" for="memberid">您的名字</label>
				              <div class="controls">
				                <input autocomplete="off" name="FMemberId" id="memberid" placeholder="你的名字" type="text" required="required">
				              </div>
				            </div>
				            <div class="control-group">
				              <label class="string required control-label" for="email">联系邮箱</label>
				              <div class="controls">
				                <input autocomplete="off" name="FEMail" id="email" placeholder="工作邮箱" type="email" required="required">
				              </div>
				            </div>
                            <div class="control-group">
                                <label class="string required control-label" for="phone">联系电话</label>
                                <div class="controls">
                                    <input autocomplete="off" name="FMobileNumber" id="phone" placeholder="联系电话" required="required">
                                </div>
                            </div>
				            <div class="control-group">
				              <label class="string required control-label" for="password">密码</label>
				              <div class="controls">
				                <input autocomplete="off" name="FPassWord" id="password" placeholder="密码" type="password" required="required">
				              </div>
				            </div>
				            <div class="align-right">
				              <input class="btn btn-success pull-right" id="signup-btn" type="submit" value="免费注册">
				            </div>
			          </fieldset>
					</form>

                    <!-- Alertbox for success -->
                    <div id="regsuccess" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        感谢您的注册
                    </div>

                    <!-- Alertbox for failure -->
                    <div id="regerror" class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        注册失败
                    </div>
                    <div class="help-block" style="margin-top:10px;color:#f8f8f8;">
			         	点击注册，表明你同意我们的服务条款和隐私政策。
			        </div>
		      	</div>
	      	</div>
		</div>
	</section>
	<div class="copyright">
		<div class="share">&copy; Copyright 2014 - <?php echo $cakeSign; ?> - All Rights Reserved. <a class="sina-weibo" href="http://weibo.com/lnbook" target="_blank"></a><a class="qq-weibo" href="http://t.qq.com/liunianbook" target="_blank"></a><a class="douban-btn" href="http://site.douban.com/228900/" target="_blank"></a><!--<a class="qq-btn" href="http://wpa.qq.com/msgrd?v=3&uin=2096519316&site=qq&menu=yes" target="_blank"></a>--></div>
	</div>
	<!-- Footer End -->
	<!-- Scroll to top -->
	<span class="totop"><a href="#home"> <i class="fa fa-chevron-up"></i> </a></span>
</div>
<!-- Wrapper End -->