<?php include_partial ( 'header' )?>
<?php if($results):?>
<?php print_r($results->response->docs)?>
<div id="main-content" class="wrapper">
	<?php include_partial ( 'search' )?>
	<div class="alert alert-info">共找到<?php echo $total?>个结果, 当前显示 <?php echo $start+1; ?> - <?php echo $end;?>：</div>
	<div class="columns single sidebar">
			<div class="column dark last">
			<h3>商品分类</h3>
			<ul id="trending-tags">
			<?php if($query == '*' && !empty($parentMenuUrl)):?>
			<li>
			<a href="/u/textquery?prefix=<?php echo $parentMenuUrl?>"><i class="icon-arrow-up"></i><?php echo $parentMenu?></a>
			</li>
			<?php endif;?>
			<?php foreach($menuArray as $menu=>$count):?>
			<li><a class="hl" href="/u/textquery?q=<?php echo $query?>&prefix=<?php echo $prefixMenuArray[$menu]?>"><?php echo $menu . '(' . $count . ')'?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div id="right-content">

		<ul id="product-list">
					<?php
	$i = 0;
	foreach ( $results->response->docs as $product ) :
		?>
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>>
					<?php include_partial ( 'productThumbnail', array('product' => $product))?>
					</li>
					<?php endforeach;?>
		</ul>
		<div class="pagination">
			<ul>
			<?php foreach($pageArray as $page):?>
			<li><a
					href="<?php echo '/u/textquery?q=' . $query . '&prefix=' . $prefix . '&page=' . $page ?>"><?php echo $page?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>
<?php endif;?>
<?php include_partial ( 'footer' )?>

