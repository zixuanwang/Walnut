<div class="show-image">
	<a href="<?php echo $product->url?>"
		title="<?php echo $product->name?>"> <img
		src="/i/<?php echo $product->imagehash . '_160.jpg'?>" width="160"
		height="160"></a>
	<div class="btn-group find-similar" style="position: absolute; top: 2px; right: 12px;">
		<button class="btn"><a href="<?php echo '/u/imagequery?t=color&imagekey=' . $product->imagekey ?>">颜色</a></button>
		<button class="btn"><i class="icon-star"></i><a href="<?php echo '/u/imagequery?t=shape&imagekey=' . $product->imagekey ?>">形状</a></button>
		<button class="btn"><a href="<?php echo '/u/imagequery?t=pattern&imagekey=' . $product->imagekey ?>">图案</a></button>
	</div>
</div>
<p class="title"><?php echo $product->name?>
				</p>
<p class="price">
	<span class="label label-warning">￥<?php echo $product->price?></span>
</p>
<p class="shop">
<span class="label label-info"><?php echo $product->merchant?></span>

</p>