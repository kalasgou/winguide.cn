<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		table {table-layout:fixed;}
		td {white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#">列表</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/article/view/search') ?>">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/article/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/article/view/lists') ?>" method="get">
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<input id="course-id" type="hidden" name="course_id" value="-1">
						<select name="course" class="form-control course-options"required>
							<option value="-1" data-course-id="-1">请选择课程模块</option>
							<?php foreach ($module as $one):?>
							<option value="<?= $one['module']?>" data-course-id="<?= $one['id']?>"><?= $one['module_desc']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">文章栏目</span>
						<input id="module-id" type="hidden" name="module_id" value="-1">
						<select id="module" name="module" class="form-control module-options" required>
						</select>
					</div>
					<button class="btn btn-primary pull-right" type="submit">筛选</button>
				</form>
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:30%;"/>
						<col style="width:10%;"/>
						<col style="width:15%"/>
						<col style="width:20%;"/>
						<col style="width:10%"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>标 题</th>
							<th>模 块</th>
							<th>栏 目</th>
							<th>日 期</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($articles as $one):?>
						<tr>
							<td><span data-uuid="<?= $one['uuid']?>"><?= $one['article_id']?></span></td>
							<td><?= $one['title']?></td>
							<td><?= $one['course']?></td>
							<td><?= $one['module']?></td>
							<td><?= $one['create_time_formatted']?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/article/view/detail?article_id='.$one['article_id'])?>"><span class="glyphicon glyphicon-file"></span></a>
								<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" data-title="Edit" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#" data-title="Delete" data-toggle="modal" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				<div class="clearfix"></div>
				<ul class="pagination pull-right">
					<?= $pagination?>
				</ul>
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control " type="text" placeholder="Mohsin">
					</div>
					<div class="form-group">
						<input class="form-control " type="text" placeholder="Irshad">
					</div>
					<div class="form-group">
						<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
					</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
				</div>
			</div>
		<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
	
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
				</div>
			</div>
		<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		$('.course-options').change(function() {
			var _upper = $(this).find('option:selected').data('course-id'); 
			$('#course-id').val(_upper);
			$.ajax({
				url: '<?= base_url('manage/article/getModules') ?>',
				data: {upper: _upper},
				type: 'get',
				dataType: 'json',
				success: function(json) {
					var modules = '<option value="-1" data-course-id="-1">请选择文章栏目</option>';
					var len = json.modules.length;
					for (var i = 0; i < len; i ++) {
						modules += '<option value="' + json.modules[i].module + '" data-module-id="' + json.modules[i].id + '">' + json.modules[i].module_desc + '</option>';
					}
					$('.module-options').empty();
					$('.module-options').append(modules);
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
	  
		$('.module-options').change(function() {
			var _module_id = $(this).find('option:selected').data('module-id'); 
			$('#module-id').val(_module_id);
		});
		
		$('td a').click(function() {
			var _entry_id = $($(this).parent().siblings('td')[0]).html()
			$('input.hidden-id').val(_entry_id);
			
			var _cur_title = $($(this).parent().siblings('td')[2]).html();
			
			switch ($(this).data('title')) {
				case 'Edit':
							$('#edit input.title').val(_cur_title);
							break;
				case 'Delete':
							$('#delete b.hints').html(_cur_title);
							break;
			}
		});
		
		$('#edit button.update').click(function() {
			var _entry_id = $('input.hidden-id').val();
			var _title = $('#edit input.title').val()
			
			$.ajax({
				url: '<?= base_url('')?>',
				data: {entry_id:_entry_id, title:_title},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					location.reload();
				},
				error: function() {
					alert('Network Error');
					location.reload();
				}
			});
		});
		
		$('#delete button.confirm').click(function() {
			var _entry_id = $('input.hidden-id').val();
			
			$.ajax({
				url: '<?= base_url('')?>',
				data: {entry_id:_entry_id},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					location.reload();
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>