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
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:15%;"/>
						<col style="width:15%;"/>
						<col style="width:15%"/>
						<col style="width:20%;"/>
						<col style="width:20%"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>课 程</th>
							<th>帐 号</th>
							<th>初始密码</th>
							<th>购买日期</th>
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
							<td><?= $one['purchase_time_formatted']?></td>
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
							<td colspan="7" align="center">暂无相关数据</td>
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
			
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							<h4 class="modal-title custom_align" id="Heading">编辑学生信息</h4>
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
							<h4 class="modal-title custom_align" id="Heading">删除文章记录</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
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
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>