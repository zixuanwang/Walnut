<?php include_partial ( 'header' )?>
<?php if($results):?>
<div class="container">
	<div class="row">
		<div class="span12">
		<?php
	$total = ( int ) $results->response->numFound;
	$start = min ( 1, $total );
	$end = min ( $limit, $total );
	?>
		Results <?php echo $start; ?> - <?php echo $end;?> of <?php echo $total; ?>:
			<div id="container"
				class="transitions-enabled infinite-scroll clearfix">
					<?php foreach ($results->response->docs as $product ):?>
										<div class="box photo col3">
					<p>
						<span class="label label-important" style="font-size: 14px;">￥<?php echo htmlspecialchars($product->price, ENT_NOQUOTES, 'utf-8')?>
										</span>
					</p>
					<a
						href="<?php echo htmlspecialchars($product->url, ENT_NOQUOTES, 'utf-8')?>"><img
						src="/i/<?php echo $product->imagehash . '.jpg'?>" /></a>
					<div class="caption">
						<h5><?php echo htmlspecialchars($product->name, ENT_NOQUOTES, 'utf-8')?></h5>
						<br />
						<p>
							<a
								href="<?php echo htmlspecialchars($product->url, ENT_NOQUOTES, 'utf-8')?>"
								class="btn btn-info">购 买</a> <span class="label label-info">amz</span>
						</p>
					</div>
				</div>
					<?php endforeach;?>
				</div>
		</div>
	</div>
	<hr>
	<footer>
		<p>&copy; Company 2012</p>
	</footer>
</div>
<?php endif;?>

