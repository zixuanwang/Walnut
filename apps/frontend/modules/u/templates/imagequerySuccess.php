<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<?php include_partial ( 'search' )?>
	<div class="columns single sidebar">
		<div class="column dark last">
			<h3>商品分类</h3>
			<ul id="trending-tags">
			</ul>
		</div>
	</div>
	<div id="right-content">

		<ul id="product-list">
					<?php
					$i = 0;
					foreach ( $productArray as $product ) :
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
					href="<?php echo '/u/imagequery?t=' . $featureType . '&imagekey=' . $imageKey . '&page=' . $page ?>"><?php echo $page?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>

<?php include_partial ( 'footer' )?>