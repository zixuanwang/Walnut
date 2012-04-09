<?php
if (count ( $product->imagehash ) > 1 && count ( $product->imagekey ) > 1) {
	$product->imagehash = $product->imagehash [0];
	$product->imagekey = $product->imagekey [0];
}

if (substr ( $product->url, 0, strlen ( 'http://' ) ) != 'http://') {
	$product->url = 'http://' . $product->url;
}
if($product->merchant=='amz'){
	$product->merchant='亚马逊';
}
if($product->merchant=='dd'){
	$product->merchant='当当网';
}
if($product->merchant=='vc'){
	$product->merchant='凡客诚品';
}
if($product->merchant=='yt'){
	$product->merchant='银泰百货';
}
?>
<div class="show-image">
	<a href="<?php echo $product->url?>"
		title="<?php echo $product->name?>"> <img
		src="/i/<?php echo $product->imagehash . '_160.jpg'?>" width="160"
		height="160"></a>
	<div class="btn-group find-similar"
		style="position: absolute; top: 2px; right: 12px;">
		<button class="btn">
			<a
				href="<?php echo '/u/imagequery?t=color&imagekey=' . $product->imagekey ?>">颜色</a>
		</button>
		<button class="btn">
			<i class="icon-star"></i><a
				href="<?php echo '/u/imagequery?t=shape&imagekey=' . $product->imagekey ?>">形状</a>
		</button>
		<button class="btn">
			<a
				href="<?php echo '/u/imagequery?t=pattern&imagekey=' . $product->imagekey ?>">图案</a>
		</button>
	</div>
</div>
<p class="title"><?php echo $product->name?>
				</p>
<p class="price">
	<span class="label label-warning">￥<?php echo $product->price?></span>
</p>
<p class="shop"><?php echo $product->merchant?>
</p>