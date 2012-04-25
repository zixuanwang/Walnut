<ul id="tab" class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#textsearch" 
		id="atextsearch">
		<div style="padding-top:2px;padding-bottom:0px">
		文本搜索
		</div>
<!--	<img id="imgtextsearch"
			src="/image/keywords_selected.png">-->
	</a></li>
	<li><a href="#linksearch" data-toggle="tab" id="alinksearch">
		<div style="padding-top:2px;padding-bottom:0px">
			图片链接
		</div>
<!--	<img
			id="imglinksearch" src="/image/pic link_unselected.png"></a>-->
	</li>
	<li><a href="#uploadsearch" data-toggle="tab"  id="auploadsearch">
<!--<img
			id="imguploadsearch" src="/image/from local_unselected.png">-->
		<div style="padding-top:2px;padding-bottom:0px">
			本地图片
		</div>
</a></li>
</ul>
<div id="myTabContent">
	<div class="tab-pane fade in active" id="textsearch">
		<form class="form-search"
			action="<?php echo url_for('u/textquery')?>" method="get">
			<input type="text" class="input-large search-query search-box"
				name="q"> <button type="submit" class="btn">查 询</button>
		</form>
	</div>
	<div class="tab-pane fade" id="linksearch">
		<form class="form-search" method="post"
			action="<?php echo url_for('u/selectimage')?>">
			<input type="text" class="input-large search-query search-box"
				name="inputlink"> <button type="submit" class="btn">查 询</button>
		</form>
	</div>
	<div class="tab-pane fade" id="uploadsearch">
		<form class="form-search" encType="multipart/form-data"
			method="post" action="<?php echo url_for('u/selectimage')?>">
			<input class="input-file" name="inputfile" type="file">
			<button type="submit" class="btn">查 询</button>
		</form>
	</div>
</div>
