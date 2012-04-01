<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<?php include_partial ( 'search' )?>
	<div class="columns single sidebar">
		<div class="column dark last">
			<h3>商品分类</h3>
			<ul id="trending-tags">
			<?php foreach($menuArray as $menu=>$count):?>
			<li><a class="hl"
					href="/u/textquery?prefix=<?php echo $prefixMenuArray[$menu]?>"><?php echo $menu?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div id="right-content">
		
		<div class="tabbable">
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#1" data-toggle="tab">热度</a></li>
				<li><a href="#2" data-toggle="tab">推荐</a></li>
				<li><a href="#3" data-toggle="tab">优惠</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="1"></div>
				<div class="tab-pane" id="2"></div>
				<div class="tab-pane" id="3"></div>
			</div>
		</div>

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
			<li><a href="<?php echo '/u/textquery?page=' . $page ?>"><?php echo $page?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<hr>
	</div>


</div>
<?php include_partial ( 'footer' )?>