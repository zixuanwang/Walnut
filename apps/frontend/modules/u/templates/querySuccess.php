<?php include_partial ( 'header' )?>

<div class="container">
	<!-- Example row of columns -->

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
			<div class="row">
				<div class="span1">
					<input type="submit" class="btn btn-info" value="上 传">
				</div>

				<div class="span1">
					<button type="reset" class="btn btn-danger">取 消</button>
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="span12">
				<?php if (isset ( $time )) :?>
				<div class="alert alert-info">
					Find results in <?php echo $time?> seconds.
				</div>
				<?php endif;?>
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
	<footer>
		<p>&copy; Company 2012</p>
	</footer>
</div>
