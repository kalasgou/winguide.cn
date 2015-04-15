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
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/lists')?>">学员</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/accounts')?>">帐号</a></li>
					<li role="presentation" class="active"><a href="#">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/student/view/search')?>" method="get" role="search">
					<div class="input-group">
						<input type="search" name="keywords" class="form-control" placeholder="搜索文章">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
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
						<tr>
							<td>1</td>
							<td>学生1</td>
							<td>13450229999</td>
							<td>GMAT</td>
							<td>000001_wg</td>
							<td>2015-04-12 13:09:54</td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="#"><span class="glyphicon glyphicon-file"></span></a>
								<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						
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