<?php include_partial ( 'header' )?>
<?php if($results):?>
<div id="main-content" class="wrapper">
	<div class="alert alert-info">共找到<?php echo $total?>个结果, 当前显示 <?php echo $start+1; ?> - <?php echo $end;?>：</div>
	<div class="columns single sidebar">
			<div class="column dark last">
			<h3>商品分类</h3>
			<ul id="trending-tags">
			<?php foreach($menuArray as $menu=>$count):?>
			<li><a class="hl" href="/u/textquery?q=*&prefix=<?php echo $prefixMenuArray[$menu]?>"><?php echo $menu . '(' . $count . ')'?></a></li>
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
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>><a
				href="<?php echo $product->url?>"
				title="<?php echo $product->name?>"> <img
					src="/i/<?php echo $product->imagehash . '_160.jpg'?>" width="160"
					height="160"></a>
				<p class="title"><?php echo $product->name?>
				</p>
				<p class="price">
					<strong>￥<?php echo $product->price?></strong>
				</p>
				<p class="shop"><?php echo $product->merchant?>
				</p></li>
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

