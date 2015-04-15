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
					<li role="presentation" class=""><a href="<?= base_url('console/admin/view/search') ?>">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/admin/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<colspan>
						<col style="width:10%;"/>
						<col style="width:20%;"/>
						<col style="width:20%;"/>
						<col style="width:20%"/>
						<col style="width:10%;"/>
						<col style="width:20%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>昵 称</th>
							<th>邮 箱</th>
							<th>日 期</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($admins as $one):?>
						<tr>
							<td><?= $one['admin_id']?></td>
							<td><?= $one['username']?></td>
							<td><?= $one['email']?></td>
							<td><?= $one['create_time_formatted']?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="#"><span class="glyphicon glyphicon-file"></span></a>
								<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				<div class="clearfix"></div>
				<ul class="pagination pull-right">
					<li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
				</ul>
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