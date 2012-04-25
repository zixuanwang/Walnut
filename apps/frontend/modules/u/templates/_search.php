<div class="tabbable" >
<ul  class="nav nav-tabs" style="margin:3px" >
<li class="active">
<a href="#textSearch" id="atextSearch" data-toggle="tab">
文本搜索</a>
</li>
<li ><a href="#imageLinkSearch" id="alinkSearch" data-toggle="tab">图片链接</a></li>
<li ><a href="#imageUploadSearch" id="auploadSearch" data-toggle="tab">本地图片</a></li>
</ul>

<div id="myTabContent" class="tab-content" style="margin-top:3px;margin-bottom:7px;background-color:#fafafa">
<div class="tab-pane active"  id="textSearch" style="margin-top:5px">
<form class="form-search"
action="<?php echo url_for('u/textquery')?>" method="get">
<input type="text" class="input-large search-query search-box"
name="q"> <button type="submit" class="btn btn-primary">查 询</button>
</form>
</div>
<div class="tab-pane" id="imageLinkSearch" style="margin-top:5px">
<form class="form-search" method="post"
action="<?php echo url_for('u/selectimage')?>">
<input type="text" class="input-large search-query search-box"
name="inputlink"> <button type="submit" class="btn btn-primary">查 询</button>
</form>
</div>
<div class="tab-pane" id="imageUploadSearch" style="margin-top:5px">
<form class="form-search" encType="multipart/form-data"
method="post" action="<?php echo url_for('u/selectimage')?>">
<input class="input-file" name="inputfile" type="file">
<button type="submit" class="btn btn-primary">查 询</button>
</form>
</div>
</div>
</div>
