<ul id="tab" class="nav nav-tabs">
	<li class="active"><a href="#textsearch" style="padding: 0;"
		id="atextsearch"><img id="imgtextsearch"
			src="/image/keywords_selected.png"></a></li>
	<li><a href="#linksearch" style="padding: 0;" id="alinksearch"><img
			id="imglinksearch" src="/image/pic link_unselected.png"></a></li>
	<li><a href="#uploadsearch" style="padding: 0;" id="auploadsearch"><img
			id="imguploadsearch" src="/image/from local_unselected.png"></a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="textsearch">
		<form class="well form-search"
			action="<?php echo url_for('u/textquery')?>" method="get">
			<input type="text" class="input-large search-query search-box"
				name="q"> <input type="image" src="/image/search button.png">
		</form>
	</div>
	<div class="tab-pane fade" id="linksearch">
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
</div>