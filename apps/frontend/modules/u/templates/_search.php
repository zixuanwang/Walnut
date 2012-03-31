<ul id="tab" class="nav nav-tabs">
	<li class="active"><a href="#linksearch" data-toggle="tab" style="padding: 0;"><img src="/image/pic link_unselected.png"></a></li>
	<li><a href="#uploadsearch" data-toggle="tab" style="padding: 0;"><img src="/image/from local_unselected.png"></a></li>
	<li><a href="#textsearch" data-toggle="tab" style="padding: 0;"><img src="/image/keywords_unselected.png"></a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="linksearch">
		<form class="well form-search">
			<input type="text" class="input-large search-query search-box"> <input
				type="image" src="/image/search button.png">
		</form>
	</div>
	<div class="tab-pane fade" id="uploadsearch">
		<form class="well form-search">
			<input type="text" class="input-large search-query search-box"> <input
				type="image" src="/image/search button.png">
		</form>
	</div>
	<div class="tab-pane fade" id="textsearch">
		<form class="well form-search"
			action="<?php echo url_for('u/textquery')?>" method="get">
			<input type="text" class="input-large search-query search-box" name="q"> <input
				type="image" src="/image/search button.png">
		</form>
	</div>
</div>