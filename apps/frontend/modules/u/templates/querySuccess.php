<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<div class="alert alert-block">
		<p>
			<strong>上传图片： 赶快去照一张照片吧</strong>
		</p>
		<br />
		<form encType="multipart/form-data" method="post"
			action="<?php
			echo url_for ( 'u/query' )?>">
			<div class="input">
				<input class="input-file" id="fileInput" name="fileInput"
					type="file" />
			</div>
			<input type="submit" class="btn btn-info" value="上 传">
			<button type="reset" class="btn btn-danger">取 消</button>
		</form>
	</div>
	<?php if (isset ( $time )) :?>
	<div class="alert alert-info">Find results in <?php echo $time?> seconds.</div>
	<?php endif;?>	
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
		foreach ( $productArray as $product ) :
			?>
				
					<li <?php if($i%4==3) echo 'class="last"'; $i++;?>><a
				href="<?php echo $product['item']['url']?>"
				title="<?php echo $product['item']['name']?>"> <img
					src="/i/<?php echo $product['image']?>" width="160" height="160"></a>
				<p>
					<a href="<?php echo $product['item']['url']?>"><?php echo $product['item']['name']?></a>
				</p>
				<p class="price">￥<?php echo $product['item']['price']?></p>
				<p class="shop">
					<span class="label label-info"><?php echo $product['item']['source']?></span>
				</p></li>
					<?php endforeach;?>
		</ul>
	</div>
</div>
<?php include_partial ( 'footer' )?>