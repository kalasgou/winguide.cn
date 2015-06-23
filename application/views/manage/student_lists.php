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
					<!--<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>-->
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/create') ?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/student/view/lists') ?>" method="get">
					<div class="input-group">
						<span class="input-group-addon">课程选择</span>
						<input id="course" type="hidden" value="<?= $args['course']?>">
						<select name="course" class="form-control course-options" required >
							<option value="">请选择课程模块</option>
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
						<span class="input-group-addon">生效日期</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">结束</span>
						<input class="form-control end-date" style="display:inline-block;" type="date" name="end_date" value="<?= $args['end_date']?>"/>
						<span class="input-group-addon">生效日期</span>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-sm" type="submit">筛选</button>
					</div>
				</form>
				<table class="table table-striped">
					<colspan>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:15%;"/>
						<col style="width:10%"/>
						<col style="width:15%;"/>
						<col style="width:10%"/>
						<col style="width:10%"/>
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
							<th>生效日期</th>
							<th>结束日期</th>
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
							<td><?= strtoupper($one['course'])?></td>
							<td><?= $one['username']?></td>
							<td title="<?= $one['start_time_formatted'];?>"><?= substr($one['start_time_formatted'], 0, 10);?></td>
							<td title="<?= $one['end_time_formatted'];?>"><?= substr($one['end_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/student/view/detail?student_id='.$one['student_id'])?>" target="_blank" title="查看学生详情"><span class="glyphicon glyphicon-info-sign"></span></a>
								<a href="#"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
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
		</div>
	</div>
	
	<input id="hidden-id" type="hidden" placeholder="you cannot see me"/>
	
	
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		var _cur_course = $('#course').val();
		$('.course-options option[value="' + _cur_course + '"]').attr('selected', 'true');
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>