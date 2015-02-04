<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php
$content = explode("\n", $content);

foreach ($content as $line):
	echo '<p> ' . $line . "</p>\n";
endforeach;
?>
<?php if (is_array($user)): ?>
	<p>收货人信息：</p>
	<p><span>姓名：<?php echo $user['name']; ?></span><span class="marl_10">电话：<?php echo $user['phone']; ?></span><span class="marl_10">地址：<?php echo $user['address']; ?></span></p>
<?php endif ?>
<?php if (is_array($product)): ?>
	<p>商品详细信息：</p>
	<?php foreach ($product as $key => $vals): ?>
		<p><span class="marr_10"><?php echo $vals['title']; ?></span><?php echo "¥{$vals['price']} / {$vals['unit']} X {$vals['count']}"; ?></p>
	<?php endforeach ?>
<?php endif ?>
