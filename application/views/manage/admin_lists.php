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
					<!--<li role="presentation" class=""><a href="<?= base_url('console/admin/view/search') ?>">搜索</a></li>-->
					<li role="presentation" class=""><a href="<?= base_url('console/admin/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/admin/view/lists') ?>" method="get">
					<div class="input-group">
						<span class="input-group-addon">帐号类型</span>
						<input id="privilege" type="hidden" value="<?= $args['privilege']?>">
						<select class="form-control privilege-options" required >
							<option value="">请选择帐号类型</option>
							<option value="<?= ADMIN?>">系统管理员</option>
							<option value="<?= TEACHER?>">教师</option>
							<option value="<?= AGENCY?>">中介</option>
						</select>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-sm" type="submit">筛选</button>
					</div>
				</form>
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:10%;"/>
						<col style="width:15%;"/>
						<col style="width:26%"/>
						<col style="width:12%;"/>
						<col style="width:12%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>类 型</th>
							<th>姓 名</th>
							<th>邮 箱</th>
							<th>创建日期</th>
							<th>更新日期</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($admins) > 0) { ?>
						<?php foreach($admins as $one):?>
						<tr>
							<td><?= $one['admin_id']?></td>
							<td><?= $one['privilege']?></td>
							<td><?= $one['username']?></td>
							<td><?= $one['email']?></td>
							<td title="<?= $one['create_time_formatted']?>"><?= substr($one['create_time_formatted'], 0, 10)?></td>
							<td title="<?= $one['update_time_formatted']?>"><?= substr($one['update_time_formatted'], 0, 10)?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="#" data-title="Edit" data-toggle="modal" data-target="#edit" title="编辑帐号信息"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" data-title="Change" data-toggle="modal" data-target="#change" title="修改帐号密码"><span class="glyphicon glyphicon-lock"></span></a>
								<a href="#" data-title="Delete" data-toggle="modal" data-target="#delete" title="删除帐号记录"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
						<?php } else { ?>
						<tr>
							<td colspan="8" align="center">暂无相关数据</td>
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
		</div>
	</div>
	
	<input class="hidden-id" type="hidden" placeholder="you cannot see me"/>
	
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">编辑帐号信息</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<span class="input-group-addon">邮箱</span><input class="form-control email" type="text" placeholder="请填写邮箱地址" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon">姓名</span><input class="form-control username" type="text" placeholder="请填写真实姓名" required />
					</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg update" style="width:100%;"><span class="glyphicon glyphicon-ok-sign"></span> 更新</button>
				</div>
			</div>
			<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
	
	<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">修改帐号密码</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<span class="input-group-addon">旧密码</span><input class="form-control old-pswd" type="password" placeholder="请填写帐号原始密码" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon">新密码</span><input class="form-control new-pswd" type="password" placeholder="请填写不少于6位字符长度的新密码" required />
					</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg submit" style="width:100%;"><span class="glyphicon glyphicon-ok-sign"></span> 提交</button>
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
					<h4 class="modal-title custom_align" id="Heading">删除帐号记录</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> 删除 <b class="hints"></b> ，你确定？</div>
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
<script type="text/javascript">
    $(document).ready(function() {
		var _cur_privilege = $('#privilege').val();
		$('.privilege-options option[value="' + _cur_privilege + '"]').attr('selected', 'true');
    
		$('td a').click(function() {
			var _entry_id = $($(this).parent().siblings('td')[0]).html()
			$('input.hidden-id').val(_entry_id);
			
			var _cur_email = $($(this).parent().siblings('td')[3]).html();
			var _cur_username = $($(this).parent().siblings('td')[2]).html();
			
			switch ($(this).data('title')) {
				case 'Edit':
							$('#edit input.email').val(_cur_email);
							$('#edit input.username').val(_cur_username);
							break;
				case 'Delete':
							$('#delete b.hints').html(_cur_username + ' (' + _cur_email + ')');
							break;
			}
		});
		
		$('#edit button.update').click(function() {
			var _entry_id = $('input.hidden-id').val();
			var _email = $('#edit input.email').val();
			var _username = $('#edit input.username').val();
			var _type = 'update';
			
			$.ajax({
				url: '<?= base_url('manage/admin/update')?>',
				data: {admin_id:_entry_id, email:_email, username:_username, type:_type},
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
			var _status = -1;
			var _type = 'trash';
			
			$.ajax({
				url: '<?= base_url('manage/admin/update')?>',
				data: {admin_id:_entry_id, status:_status, type:_type},
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
		
		$('#change button.submit').click(function() {
			var _entry_id = $('input.hidden-id').val();
			var _old_pswd = hex_md5($('#change input.old-pswd').val());
			var _new_pswd = hex_md5($('#change input.new-pswd').val());
			var _type = 'reset';
			
			$.ajax({
				url: '<?= base_url('manage/admin/update')?>',
				data: {admin_id:_entry_id, old_pswd:_old_pswd, new_pswd:_new_pswd, type:_type},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					if (json.code == 0) {
						alert(json.msg);
						location.reload();
					} else {
						alert('旧密码不正确，无法更新密码');
					}
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
	});
</script>
<?php include APPPATH .'views/manage/footer.php'?>