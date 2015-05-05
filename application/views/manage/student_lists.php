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
					<li role="presentation" class="active"><a href="#">学员</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/accounts') ?>">帐号</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:10%;"/>
						<col style="width:15%;"/>
						<col style="width:10%"/>
						<col style="width:20%;"/>
						<col style="width:20%"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>姓 名</th>
							<th>电 话</th>
							<th>课 程</th>
							<th>帐 号</th>
							<th>日 期</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($students) > 0) { ?>
						<?php foreach($students as $one):?>
						<tr>
							<td><span data-user-id="<?= $one['user_id']?>"><?= $one['student_id']?></span></td>
							<td><?= $one['real_name']?></td>
							<td><?= $one['cellphone']?></td>
							<td><?= $one['course']?></td>
							<td><?= $one['username']?></td>
							<td><?= $one['purchase_time_formatted']?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/student/view/detail?student_id='.$one['student_id'])?>" target="_blank"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="#"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
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
	
	
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>