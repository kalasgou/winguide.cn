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
								<a href="#" data-title="Edit" data-toggle="modal" data-target="#edit" title="编辑帐户信息"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" data-title="Configure" data-toggle="modal" data-target="#configure" title="重置帐户密码"><span class="glyphicon glyphicon-lock"></span></a>
								<a href="#" data-title="Delete" data-toggle="modal" data-target="#delete" title="删除帐户记录"><span class="glyphicon glyphicon-trash"></span></a>
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
	
	<input id="hidden-id" type="hidden" placeholder="you cannot see me"/>
	
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">编辑管理帐号</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<input class="form-control " type="text" placeholder="Mohsin">
					</div>
					<div class="input-group">
						<input class="form-control " type="text" placeholder="Irshad">
					</div>
					<div class="input-group">
						<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
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
					<h4 class="modal-title custom_align" id="Heading">删除管理帐号</h4>
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
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>