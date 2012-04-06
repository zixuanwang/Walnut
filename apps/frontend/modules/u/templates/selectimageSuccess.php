<div id="myModal" class="modal hide fade in">
	<div class="modal-header">
		<a class="close" href="<?php echo url_for('@homepage')?>">×</a>
		<h3>请选择图片类别</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="span3">
				<img src="<?php echo '/uploads/' . $imagePath?>">
			</div>
			<div class="span2">
				<div id="treeContainer" class="control-group">
					<select id="sub_0" class="catSel">
						<option>请选择类别</option>
					</select>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		var categoryArray=new Array();
		$.getJSON('/js/category.json', function(data) {
			  $.each(data, function(key, val) {
				  $('#sub_0').append($('<option>').text(val.name).attr('value', key));
				  categoryArray[key]=val;
			  });
			});
		///when the selected option chagnes, udpat its direct children category if there are any
		$(".catSel").live("change", function(){
			///get the category level
			var idStr = $(this).attr('id');
			var selLevel = parseInt(idStr.split('_')[1]);
			///pull out parent levels and try to add a children selection if not exist yet
			var l = 0;
			///current selected lists
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
			var rmStart = selLevel + 1;
			if(curSelList != undefined || curSelList.length > 0)
			{
				///check the existence of child selection
				var childLevel = selLevel + 1;
				var childId = "sub_" + childLevel;
				var childSelInput = $("#" + childId);
				if(childSelInput.length >0  )
				{
					///remove all existing options
					childSelInput.find('option').remove();				
				}
				else{
					var addedSel = $("<select>").attr('id',childId).attr('class','catSel');
					childSelInput = addedSel;
					addedSel.appendTo($("#treeContainer"));
				}
				///add curSelList to childSelInput
				$.each(curSelList, function (key, val)
					{
						childSelInput.append($('<option>').text(val.name).attr('value', key));
					}
				);
			}
			rmStart += 1;
			///remove the compoents afterwards
			for(;; rmStart++)
			{
				var tmpSelInput = $("#sub_" + rmStart);
				if(tmpSelInput.length > 0)
				{
					tmpSelInput.remove();
					continue;
				}
				break;
			}		
		}
		);
		$(document).ready(function()
		{
			$('#myModal').modal('show');
		});		
    </script>
	</div>
	<div class="modal-footer">
		<a href="<?php echo url_for('@homepage')?>" class="btn">取 消</a> <a
			href="#" class="btn btn-inverse">查 询</a>
	</div>
</div>