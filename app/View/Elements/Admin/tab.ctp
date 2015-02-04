<?php
$deep = 0;
if (in_array($WC_query['mod'], array_keys($nav))){
	$nav[$WC_query['mod']]['active'] = TRUE;
} else {
	$deep = 1;
}
?>
<?php foreach ($nav as $key => $vals): ?>
	<?php
		$vals['active'] = $deep ? (isset($vals['default']) ? TRUE : FALSE) : $vals['active'];
		$view['actvop'] = $vals['active'] ? 'active' : '';
		$uri = isset($vals['uri']) ? $vals['uri'] : "#{$key}";
		$tab = isset($vals['uri']) ? '' : 'data-toggle="tab"';
	?>
	<li class="<?php echo $view['actvop']; ?>">
		<a <?php echo $tab;?> href="<?php echo $uri; ?>"><?php echo $vals['name']; ?></a>
	</li>
<?php endforeach ?>
