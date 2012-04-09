<?php include_partial ( 'header' )?>
<div id="main-content" class="wrapper">
	<div class="well">当您进入核桃的页面后，可以通过如下的方式来搜索，浏览来自不同商家的产品信息。</div>
	<div class="accordion" id="accordion2">
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse"
					data-parent="#accordion2" href="#textSearch"> 基于关键字的搜索 </a>
			</div>
			<div id="textSearch" class="accordion-body collapse in">
				<ol>
					<li>
						<p>输入商品的关键字，点击“查询“按钮，系统返回符合关键字的产品</p>
						<div>
							<img src="/image/guidance/text-result.png" width="70%" />
						</div>
					</li>
				</ol>
			</div>
		</div>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse"
					data-parent="#accordion2" href="#imageSearch"> 基于产品图片的搜索 </a>
			</div>
			<div id="imageSearch" class="accordion-body collapse">
				<ol>
					<li>
						<p>提供待查产品的图片，您可以通过以下两种方式提供</p>
						<ul>
							<li>
								<p>
									<b>产品的链接</b>或者<b>本地上传</b>
								</p>
								<div>
									<img src="/image/guidance/image-upload.png" width="70%" />
								</div>
							</li>
						</ul>
					</li>
					<li>
						<p>点击“查询“按钮后，进入产品类别选择界面</p>
						<div>
							<img src="/image/guidance/image-category.png" width="50%" />
						</div>
					</li>
					<li>
						<p>点击“查询“，系统返回查询结果</p>
					</li>
				</ol>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse"
					data-parent="#accordion2" href="#similarBrowse">浏览相似产品 </a>
			</div>
			<div id="similarBrowse" class="accordion-body collapse">
				<div class="accordion-inner">您可以通过三种方式来浏览相似图片：相似颜色，相似形状，相似图案</div>
				<ol>
					<li>
						<p>
							将鼠标移至产品的图片上，在图片的顶部会浮现出相似产品搜索工具栏，选项分别为：<strong>颜色，形状和图案</strong>
						</p>
						<div>
							<img src="/image/guidance/similar-toolbar.png" width="70%" />
						</div>
					</li>
					<li>
						<p>
							用户点击 <strong>颜色</strong> 浏览颜色相近的产品
						</p>
						<div>
							<img src="/image/guidance/similar-color.png" width="70%" />
						</div>
					</li>
					<li>
						<p>
							用户点击 <strong>形状</strong> 浏览形状相近的产品
						</p>
						<div>
							<img src="/image/guidance/similar-shape.png" width="70%" />
						</div>
					</li>
					<li>
						<p>
							用户点击 <strong>图案</strong> 浏览图案相近的产品
						</p>
						<div>
							<img src="/image/guidance/similar-pattern.png" width="70%" />
						</div>
					</li>

				</ol>
			</div>
		</div>
	</div>
</div>
<?php include_partial ( 'footer' )?>
