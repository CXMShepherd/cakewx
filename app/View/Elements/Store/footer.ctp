<nav id="footer" class="bar bar-tab">
    <a class="tab-item <?php if($action == 'store') echo 'active' ?>" href="<?php echo $this->Html->url(array("controller" => "mob", "action" => "store")); ?>">
        <span class="icon iconfont">&#xe627</span>
        <span class="tab-label">店铺</span>
    </a>
    <a class="tab-item <?php if($action == 'shopping') echo 'active' ?>" href="<?php echo $this->Html->url(array("controller" => "mob", "action" => "shopping"
    )); ?>">
        <span class="icon iconfont">&#xe61c</span>
        <span class="tab-label">购物</span>
    </a>
    <a  class="tab-item <?php if($action == 'cart') echo 'active' ?>" href="<?php echo $this->Html->url(array("controller" => "mob", "action" => "cart"
    )); ?>">
        <span class="icon iconfont">&#xe612</span>
        <span class="tab-label">购物车</span>
    </a>
    <a  class="tab-item <?php if($action == 'ucenter') echo 'active' ?>" href="<?php echo $this->Html->url(array("controller" => "mob", "action" => "ucenter"
    )); ?>">
        <span class="icon iconfont">&#xe60e</span>
        <span class="badge disno">5</span>
        <span class="tab-label">个人中心</span>
    </a>
</nav>