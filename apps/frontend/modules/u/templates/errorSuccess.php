<div id="myModal" class="modal hide fade in">
	<div class="modal-header">
		<a class="close" href="<?php echo url_for('@homepage')?>">×</a>
		<h3>出错啦</h3>
	</div>
	<div class="modal-body">
		<?php echo $sf_user->getAttribute('errorMessage')?>
		<script type="text/javascript">
		$(document).ready(function()
		{
			$('#myModal').modal('show');
		});		
    	</script>
	</div>
	<div class="modal-footer"> <a
			href="<?php echo url_for('@homepage')?>" class="btn btn-inverse">确 定</a>
	</div>
</div>