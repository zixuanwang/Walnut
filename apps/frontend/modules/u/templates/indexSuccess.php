<?php
include_partial ( 'header' )?>
<div class="container">
	<div class="row">
		<div class="span3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">图书音像</li>
					<li><a href="#">人物传记</a></li>
					<li><a href="#">历史</a></li>
					<li><a href="#">小说</a></li>
					<li class="nav-header">电子产品</li>
					<li><a href="#">笔记本电脑</a></li>
					<li><a href="#">手机</a></li>
					<li><a href="#">音箱</a></li>
					<li class="nav-header">时装</li>
					<li><a href="#">女装</a></li>
					<li><a href="#">男装</a></li>
					<li><a href="#">包包</a></li>
				</ul>
			</div>
			<!--/.well -->
		</div>
		<!--/span-->
		<div class="span9">
			<div class="hero-unit">
				<h2>欢迎访问核桃</h2>
				<p>我们旨在帮助用户迅捷买到中意的商品。用户通过我们的服务可以从不计其数的电子商务网站和实体店中发现自己最感兴趣的商品。我们的产品包含两部分核心技术：基于图像的商品搜索和基于社交网络的推荐。在移动互联网迅速发展的今天，用户只需将感兴趣的商品信息收集到手机上，包括照片、商品类别（手包，鞋子等）、商品的特点（大小，材质等）、价格范围和地理位置，通过使用我们的产品，用户能够轻松锁定相同或者类似的商品，以及最优惠的价格和最方便的购买方式。基于图像的搜索技术以及基于位置的服务，是我们独特的解决方案，在中国市场具有开创性。我们的目标是做中国的实物搜索引擎。</p>
				<p>
					<a class="btn btn-primary btn-large"
						href="<?php echo url_for('u/query')?>">图 片 搜 索</a>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div id="container"
				class="transitions-enabled infinite-scroll clearfix">
					<?php foreach ($productArray as $product):?>
					<div class="box photo col3">
						<p>
							<span class="label label-important" style="font-size: 14px;">￥<?php echo $product['item']['price']?>
										</span>
						</p>
						<a href="<?php echo $product['item']['url']?>"><img
						src="/i/<?php echo $product['image']?>" /></a>
						<div class="caption">
						<h5><?php echo $product['item']['name']?></h5>
						<br />
						<p>
							<a href="<?php echo $product['item']['url']?>"
								class="btn btn-info">购 买</a> <span class="label label-info"><?php echo $product['item']['source']?></span>
						</p>
						</div>
					</div>
					<?php endforeach;?>
				</div>
		</div>
	</div>
	<hr>
	<div class="pagination">
		<ul>
			<li><nav id="page-nav">
					<a href="/u/index?next">Next</a>
				</nav></li>
		</ul>
	</div>
	<footer>
		<p>&copy; Company 2012</p>
	</footer>

</div>