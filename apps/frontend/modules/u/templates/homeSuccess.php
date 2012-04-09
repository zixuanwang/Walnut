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
			<?php foreach($pageArray as $p):?>
			<?php if($p==$page){
				$flag=' class="active"';
			}else{
				$flag='';
			}
			?>
			<li<?php echo $flag?>><a href="<?php echo '/u/textquery?page=' . $p ?>"><?php echo $p + 1?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<hr>
	</div>


</div>
<?php include_partial ( 'footer' )?>