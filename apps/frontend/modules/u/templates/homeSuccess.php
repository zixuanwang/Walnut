<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<div class="hero-unit">
		<h2>欢迎访问核桃</h2>
		<p>我们旨在帮助用户迅捷买到中意的商品。用户通过我们的服务可以从不计其数的电子商务网站和实体店中发现自己最感兴趣的商品。基于图像的搜索技术以及基于位置的服务，是我们独特的解决方案，在中国市场具有开创性。</p>
		<p>
			<a class="btn btn-danger btn-large"
				href="<?php echo url_for('u/query')?>">图 片 搜 索</a>
		</p>
	</div>
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
		<hr>
		<h3>Trending Shops</h3>
		<ul class="sellers_homepage">

			<li><a href="http://shoply.com/shop/serendipitygirlsdesignerdre/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/bc11719b553f889e5b2f6c97cd3d2490.jpg"
					alt="Serendipity Girls Designer Dresses" width="110" height="75">

			</a>
				<p class="name">Serendipity Girls Designer Dresses</p>
				<p class="price">106 fans</p></li>

			<li><a href="http://shoply.com/shop/eyeformation/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/f9cdd8b3d3939c3eadbff9e537742e5a.jpg"
					alt="eyeformation" width="110" height="75">

			</a>
				<p class="name">eyeformation</p>
				<p class="price">93 fans</p></li>

			<li><a href="http://shoply.com/shop/yournestinspired/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/9e0007ddb11a6fe12606fa0dbe254fde.jpg"
					alt="your nest inspired" width="110" height="75">

			</a>
				<p class="name">your nest inspired</p>
				<p class="price">92 fans</p></li>

			<li><a href="http://shoply.com/shop/anonimamentedesign/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/db70a0c0fd425c21f693c471858267e3.jpg"
					alt="anonima|Mente design" width="110" height="75">

			</a>
				<p class="name">anonima|Mente design</p>
				<p class="price">88 fans</p></li>

			<li><a href="http://shoply.com/shop/fittobestitched/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/fde77ff5bfbea878748666cbfd85b718.jpg"
					alt="Fit To Be Stitched" width="110" height="75">

			</a>
				<p class="name">Fit To Be Stitched</p>
				<p class="price">83 fans</p></li>

			<li class="last"><a href="http://shoply.com/shop/drobart/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/5f811ebaadd15a41d22603a092cc309f.jpg"
					alt="drobart" width="110" height="75">

			</a>
				<p class="name">drobart</p>
				<p class="price">78 fans</p></li>

			<li><a href="http://shoply.com/shop/ladylizziescuriosities/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/f8d04ef9b5335a6f852a92eebadf60b8.jpg"
					alt="Lady Lizzie&#39;s Curiosities" width="110" height="75">

			</a>
				<p class="name">Lady Lizzie's Curiosities</p>
				<p class="price">68 fans</p></li>

			<li><a href="http://shoply.com/shop/threado/"> <img class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/3f70f64369f34b9f9b527e98db1dc7d7.jpg"
					alt="threado" width="110" height="75">

			</a>
				<p class="name">threado</p>
				<p class="price">67 fans</p></li>

			<li><a href="http://shoply.com/shop/vanilladesign/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/618fe1b5f54d5194a69b0ea1d4ba708e.jpg"
					alt="VanillaDesign" width="110" height="75">

			</a>
				<p class="name">VanillaDesign</p>
				<p class="price">62 fans</p></li>

			<li><a href="http://shoply.com/shop/springhillstudio/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/c366514451ba561d1c6d922775ba8f7d.jpg"
					alt="springhillstudio" width="110" height="75">

			</a>
				<p class="name">springhillstudio</p>
				<p class="price">58 fans</p></li>

			<li><a href="http://shoply.com/shop/nicolestore/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/e772854c69d525b351aae30f37c08710.jpg"
					alt="Nicole Design Store" width="110" height="75">

			</a>
				<p class="name">Nicole Design Store</p>
				<p class="price">53 fans</p></li>

			<li class="last"><a href="http://shoply.com/shop/kevmundayart/"> <img
					class="avatar"
					src="./Shopping Marketplace packed with talent, innovation and attitude._files/2218186ef07c1de13c2688f31f2da045.jpg"
					alt="Kev Munday Original Art &amp; Prints" width="110" height="75">

			</a>
				<p class="name">Kev Munday Original Art &amp; Prints</p>
				<p class="price">53 fans</p></li>

		</ul>
	</div>


</div>
<?php include_partial ( 'footer' )?>