<div id="hd">
	<div class="wrapper">
		<a id="shoply-logo" href="<?php echo url_for('@homepage') ?>"
			title="Home"><img src="/image/logo.png"></a>
		<ul id="nav">
			<li id="search-bar">
				<form id="search" action="<?php echo url_for('u/textquery')?>"
					method="get">
					<input type="text" value="" id="keywords" name="q"
						data-placeholder="Search products">
				</form>
			</li>
			<li><a class="navlink" href="http://walnutvision.net">博客</a></li>
			<li><a class="navlink" href="mailto:zixuanwang@gmail.com">联系我们</a></li>
		</ul>
	</div>
</div>
