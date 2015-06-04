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
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/lists') ?>">学员</a></li>
					<li role="presentation" class="active"><a href="#">帐号</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/student/view/accounts') ?>" method="get">
					<div class="input-group">
						<span class="input-group-addon">购买课程</span>
						<select name="course" class="form-control course-options" required>
							<option value=" ">全部课程</option>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
							<option value="gaokao">高考</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">起始</span>
						<input class="form-control start-date" style="display:inline-block;" type="date" name="start_date" value="<?= $args['start_date']?>"/>
						<span class="input-group-addon">购买日期</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">结束</span>
						<input class="form-control end-date" style="display:inline-block;" type="date" name="end_date" value="<?= $args['end_date']?>"/>
						<span class="input-group-addon">购买日期</span>
					</div>
					<div class="pull-right">
						<button class="btn btn-success btn-sm download-excel" type="button">导出</button>
						<button class="btn btn-primary btn-sm" type="submit">筛选</button>
					</div>
				</form>
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:15%;"/>
						<col style="width:15%;"/>
						<col style="width:15%"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>课 程</th>
							<th>帐 号</th>
							<th>初始密码</th>
							<th>有限时长</th>
							<th>购买日期</th>
							<th>激活日期</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($accounts) > 0) { ?>
						<?php foreach($accounts as $one):?>
						<tr>
							<td><?= $one['student_id']?></td>
							<td><?= $one['course']?></td>
							<td><?= $one['username']?></td>
							<td><?= $one['init_pswd']?></td>
							<td><?= $one['duration']?>天</td>
							<td title="<?= $one['create_time_formatted'];?>"><?= substr($one['create_time_formatted'], 0, 10);?></td>
							<td title="<?= $one['update_time_formatted'];?>"><?= substr($one['update_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="#" title="查看学生信息"><span class="glyphicon glyphicon-info-sign"></span></a>
								<a href="#" data-title="Edit" data-toggle="modal" data-target="#edit" title="编辑学生信息"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" data-title="Configure" data-toggle="modal" data-target="#configure" title="变更学生状态"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#" data-title="Delete" data-toggle="modal" data-target="#delete" title="删除学生记录"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
						<?php } else { ?>
						<tr>
							<td colspan="9" align="center">暂无相关数据</td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				<div class="clearfix"></div>
				<ul class="pagination pull-right">
					<?= $pagination?>
				</ul>
			</div>
			
			<input id="hidden-id" type="hidden" placeholder="You can not see me"/>
			
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							<h4 class="modal-title custom_align" id="Heading">编辑学生信息</h4>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<span class="input-group-addon">帐号名称</span>
								<input class="form-control username" type="text" placeholder="Username" readonly/>
							</div>
							<div class="input-group">
								<span class="input-group-addon">选择课程</span>
								<select class="form-control courses" required>
									<option value="gmat">GMAT</option>
									<option value="gre">GRE</option>
									<option value="ielts">IELTS</option>
									<option value="sat">SAT</option>
									<option value="toefl">TOEFL</option>
									<option value="gaokao">高考</option>
								<select>
							</div>
						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-warning btn-lg update" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> 更新</button>
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
							<h4 class="modal-title custom_align" id="Heading">删除学生帐号</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> 删除 <b class="hints"></b> 你确定？</div>
						</div>
						<div class="modal-footer ">
							<button type="button" class="btn btn-success confirm" ><span class="glyphicon glyphicon-ok-sign"></span> 确定</button>
							<button type="button" class="btn btn-default cancel" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 取消</button>
						</div>
					</div>
				<!-- /.modal-content --> 
				</div>
				<!-- /.modal-dialog --> 
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		var _cur_course = getQueryString('course');
		$('.course-options option[value="' + _cur_course + '"]').attr('selected', 'true');
		
		$('td a').click(function() {
			var _entry_id = $($(this).parent().siblings('td')[0]).html()
			$('input.hidden-id').val(_entry_id);
			
			var _cur_course = $($(this).parent().siblings('td')[1]).html();
			var _cur_username = $($(this).parent().siblings('td')[2]).html();
			
			switch ($(this).data('title')) {
				case 'Edit':
							$('#edit input.username').val(_cur_username);
							$('#edit select.courses').val(_cur_course);
							break;
				case 'Delete':
							$('#delete b.hints').html(_cur_username);
							break;
			}
		});
		
		$('#edit button.update').click(function() {
			var _entry_id = $('input.hidden-id').val();
			var _title = $('#edit input.title').val()
			
			$.ajax({
				url: '<?= base_url('schedule/updateEntry')?>',
				data: {id:_entry_id, title:_title},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					alert(json.msg);
					location.reload();
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
		
		$('#delete button.confirm').click(function() {
			var _entry_id = $('input.hidden-id').val();
			
			$.ajax({
				url: '<?= base_url('schedule/updateEntry')?>',
				data: {id:_entry_id, status:0},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					alert(json.msg);
					location.reload();
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
		
		$('.download-excel').click(function() {
			var _course = $('.course-options').val();
			var _start_date = $('.start-date').val();
			var _end_date = $('.end-date').val();
			
			location.href = '<?= base_url('manage/student/accountsExcel?course=')?>' + _course + '&start_date=' + _start_date + '&end_date=' + _end_date;
		});
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>