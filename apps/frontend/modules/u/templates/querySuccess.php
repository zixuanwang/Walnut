<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<?php include_partial ( 'search' )?>
	<div class="columns single sidebar">
		<div class="column dark last">
			<h3>
				<a href="<?php echo url_for('@homepage')?>">返回首页</a>
			</h3>
			<ul id="trending-tags">
			</ul>
		</div>
	</div>
	<div id="right-content">
		<ul id="product-list">
			<div class="alert">
				<strong>相似颜色</strong>
			</div>
					<?php
					$i = 0;
					foreach ( $colorProductArray as $product ) :
						?>
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>>
					<?php include_partial ( 'productThumbnail', array('product' => $product))?>
					</li>
					<?php endforeach;?>
		</ul>
		<ul id="product-list">
			<div class="alert alert-info">
				<strong>相似形状</strong>
			</div>
					<?php
					$i = 0;
					foreach ( $shapeProductArray as $product ) :
						?>
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>>
					<?php include_partial ( 'productThumbnail', array('product' => $product))?>
					</li>
					<?php endforeach;?>
		</ul>
		<ul id="product-list">
			<div class="alert alert-success">
				<strong>相似图案</strong>
			</div>
					<?php
					$i = 0;
					foreach ( $surfProductArray as $product ) :
						?>
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>>
					<?php include_partial ( 'productThumbnail', array('product' => $product))?>
					</li>
					<?php endforeach;?>
		</ul>
	</div>
</div>

<?php include_partial ( 'footer' )?>