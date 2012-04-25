<?php include_partial ( 'header' )?>
<?php $pageUrl='/u/imagequery?t=' . $featureType . '&imagekey=' . $imageKey . '&page=' . $page;?>
<div id="main-content" class="wrapper">
	<?php include_partial ( 'search' )?>
	<div class="columns single sidebar">
		<div class="column dark last">
			<h3>
				<a href="<?php echo url_for('@homepage')?>">返回首页</a>
			</h3>
			<ul id="trending-tags">
				<h4>品牌</h4>
			<?php foreach($brandFacet as $key => $value):?>
			<li><a class="hl" href="<?php echo $pageUrl . '&brand=' . $key?>"><?php echo $key . '(' . $value . ')'?></a></li>
			<?php endforeach;?>
			<h4>价格</h4>
			<?php foreach($priceFacet as $key => $value):?>
			<?php
				$startPrice = $key + 0;
				$endPrice = $key + 100;
				if ($key == 500) {
					$endPrice = 'more';
				}
				?>
			<li><a class="hl"
					href="<?php echo $pageUrl . '&pricerange=' . $startPrice?>"><?php echo $startPrice . ' - ' . $endPrice .  '(' . $value . ')'?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>

	<div id="right-content">
		<ul class="breadcrumb">
			<li><a href="<?php echo $pageUrl . '&sortprice=true'?>">按价格排序</a> <span
				class="divider">/</span></li>
			<li>按人气排序 <span class="divider">/</span></li>
			<li>按评分排序</li>
		</ul>

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