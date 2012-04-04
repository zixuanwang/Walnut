<div id="myModal" class="modal hide fade in">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3 id="testh3">请选择图片类别</h3>
	</div>
	<div class="modal-body">
		<img src="<?php echo '/uploads/' . $imagePath?>">
		<hr>
		<div class="control-group">
			<select id="myselect1"></select> <select id="subcategory"></select>
		</div>
		<script type="text/javascript">
		var categoryArray=new Array();
		$.getJSON('/js/category.json', function(data) {
			  $.each(data, function(key, val) {
				  $('#myselect1').append($('<option>').text(val.name).attr('value', key));
				  categoryArray[key]=val;
			  });
			});
		$('#myselect1').change(function() {
			$('#subcategory').find('option').remove();
			$.each(categoryArray[$(this).val()].children, function(key, val){
				//alert(val.name);
				$('#subcategory').append($('<option>').text(val.name).attr('value', key));
				});
			});
    </script>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">取 消</a> <a href="#"
			class="btn btn-primary">查 询</a>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$('#myModal').modal('show');
});

</script>