<div id="myModal" class="modal hide fade in">
	<div class="modal-header">
		<a class="close" href="<?php echo url_for('@homepage')?>">×</a>
		<h3>请选择图片类别</h3>
	</div>
	<form action="<?php echo url_for('u/query')?>" method="post">
		<div class="modal-body">
			<div class="row">
				<div class="span3">
					<img src="<?php echo '/uploads/' . $imagePath?>">
				</div>
				<div class="span2">
					<div id="treeContainer" class="control-group">
						<select id="sub_0" name="sub_0" class="catSel">
							<option>请选择类别</option>
						</select>
						<input type="hidden" name="path" value="<?php echo $imagePath?>">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-inverse">查 询</button>
		</div>
	</form>
</div>
<script type="text/javascript">
		var categoryArray=new Array();
		$.getJSON('/js/category.json', function(data) {
			  $.each(data, function(key, val) {
				  $('#sub_0').append($('<option>').text(val.name).attr('value', key));
				  categoryArray[key]=val;
			  });
			  ///now trigger the sub category pop-out
			  updateSubCategory($("#sub_0"));
			});
		
		function removeSubSelect(selLevel)
		{
			for(;;selLevel++)
			{
				tmpSelInput = $("#sub_" + selLevel);
				if(tmpSelInput.length > 0)
				{
					tmpSelInput.remove();
					continue;
				}
				break;
			}
		}
		///update sub-categories of current selected categories
		function updateSubCategory(curSelCat)
		{
			///get current selected category list
			var idStr = curSelCat.attr('id');
			var selLevel = parseInt(idStr.split('_')[1]);
			var selText = curSelCat.find("option:selected").text();
			if(selText.indexOf("图书") != -1)
			{
				selLevel++;
				removeSubSelect(selLevel);
				return;
			}
			///pull out parent levels and try to add a children selection if not exist yet
			var l = 0;
			///current selected lists(actually direct subcategories of currently selected category)
			var curSelList = null;
			for(l = 0; l <= selLevel; l++)
			{
				var tmpSelId = "#sub_" + l;
				var tmpSelVal = $(tmpSelId).val();
				if( l == 0)
				{
					curSelList = categoryArray[tmpSelVal].children;
				}
				else{
					curSelList = curSelList[tmpSelVal].children;
				}
			}
			
			///now set all the subsequent categories to the default value
			var subLevel = selLevel + 1;
			var defaultSelPos = 0;
			var listContainer = $("#treeContainer");
			for(;;subLevel++)
			{
				if(curSelList == undefined || curSelList.length == 0)
				{
					break;
				}
				var curSelInput = $("#sub_" + subLevel);
				if(curSelInput.length > 0)
				{
					curSelInput.find("option").remove();
				}
				else
				{
					curSelInput = $("<select>").attr("id","sub_" + subLevel).attr("name","sub_" + subLevel).attr("class","catSel").val(defaultSelPos);
					curSelInput.appendTo(listContainer);
				}
				///populate the list
				$.each(curSelList,function(key,val)
				{
					//key is the index, value is the category name
					$("<option>").text(val.name).val(key).appendTo(curSelInput);
				}
				);
				//change current selected list
				curSelList = curSelList[0].children;
			}
			
			removeSubSelect(subLevel);
		}
		///simply trigger sub-categorie changes
		$(".catSel").live("change", function(){
			updateSubCategory($(this));
		}
		);
		$(document).ready(function()
		{
			$('#myModal').modal('show');
		});		
    </script>