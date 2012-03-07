<style type="text/css">
body {
	padding-top: 60px;
	padding-bottom: 40px;
}
</style>
<script>
  $(function(){
    
    var $container = $('#container');
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.box',
        columnWidth: 380
      });
    });
    
  });
</script>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
				data-target=".nav-collapse"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
			</a> <a class="brand" href="<?php echo url_for('u/index')?>">核桃</a>
			<div class="nav-collapse">
				<form class="navbar-search pull-left"
					action="<?php echo url_for('u/textquery')?>">
					<input name="q" type="text" class="search-query span4" placeholder="搜索">
				</form>
				<ul class="nav">
					<li><a href="http://walnutvision.net">博客</a>
					<li><a href="mailto:zixuanwang@gmail.com">联系我们</a>
				
				</ul>
				<p class="navbar-text pull-right">
					登录<a href="#">用户名</a>
				</p>


			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
</div>
