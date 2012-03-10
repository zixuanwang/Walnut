<?php include_partial ( 'header' )?>
<?php if($results):?>
<div id="main-content" class="wrapper">
	<div class="alert alert-info">共找到结果 <?php echo $start; ?> - <?php echo $end;?>：</div>
	<div class="columns single sidebar">
		<div class="column dark last">
			<h3>Showcase</h3>
			<ul id="trending-tags">
				<li><a class="hl" href="http://shoply.com/marketplace/accessories/">Accessories</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/art/">Art</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/clothing/">Clothing</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/crafts/">Crafts</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/edibles/">Edibles</a></li>

				<li><a class="hl"
					href="http://shoply.com/marketplace/entertainment/">Entertainment</a></li>

				<li><a class="hl"
					href="http://shoply.com/marketplace/health_beauty/">Health &amp;
						Beauty</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/home/">Home</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/jewelry/">Jewelry</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/outdoor/">Outdoor</a></li>

				<li><a class="hl" href="http://shoply.com/marketplace/pets/">Pets</a></li>

				<li><a class="hl"
					href="http://shoply.com/marketplace/everything_else/">Everything
						Else</a></li>
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
					src="/i/<?php echo $product->imagehash . '.jpg'?>" width="160"
					height="160"></a>
				<p>
					<a href="<?php echo $product->url?>"><?php echo $product->name?></a>
				</p>
				<p class="price">￥<?php echo $product->price?></p>
				<p class="shop">
					<span class="label label-info">amz</span>
				</p></li>
					<?php endforeach;?>
		</ul>
		<div class="pagination">
			<ul>
			<?php foreach($pageArray as $page):?>
			<li><a href="<?php echo '/u/textquery?q=' . $query . '&page=' . $page ?>"><?php echo $page?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>
<?php endif;?>
<?php include_partial ( 'footer' )?>

