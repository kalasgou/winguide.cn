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
					<li role="presentation" class="active"><a href="#">任务</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=course')?>">布置作业</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/lists')?>">题库</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/create')?>">新建习题</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/forum/view/lists') ?>" method="get">
					<div class="input-group">
						<span class="input-group-addon">购买课程</span>
						<input id="course" type="hidden" name="course" value="<?= $args['course']?>">
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
						<span class="input-group-addon">题库编者</span>
						<input id="admin" type="hidden" name="admin_id" value="<?= $args['course']?>">
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
						<span class="input-group-addon">创建日期</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">结束</span>
						<input class="form-control end-date" style="display:inline-block;" type="date" name="end_date" value="<?= $args['end_date']?>"/>
						<span class="input-group-addon">创建日期</span>
					</div>
					<div class="pull-right">
						<button class="btn btn-primary btn-sm" type="submit">筛选</button>
					</div>
				</form>
				<table class="table table-striped">
					<colspan>
						<col style="width:5%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:30%;"/>
						<col style="width:5%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>作 者</th>
							<th>课 程</th>
							<th>话 题</th>
							<th>置 顶</th>
							<th>创建时间</th>
							<th>更新时间</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($topics) > 0) { ?>
						<?php foreach($topics as $one):?>
						<tr>
							<td><span data-uuid="<?= $one['uuid']?>"><?= $one['topic_id'];?></span></td>
							<td><?= $one['admin_id'];?></td>
							<td><?= $one['module'];?></td>
							<td><?= $one['topic'];?></td>
							<!--<td><?= $one['thread'];?></td>-->
							<td><?= $one['recommend'];?></td>
							<td title="<?= $one['create_time_formatted'];?>"><?= substr($one['create_time_formatted'], 0, 10);?></td>
							<td title="<?= $one['update_time_formatted'];?>"><?= substr($one['update_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/forum/view/detail?topic_id='.$one['topic_id'])?>" title="编辑作业内容"><span class="glyphicon glyphicon-edit" title=""></span></a>
								<a href="#" title="浏览作业反馈"><span class="glyphicon glyphicon-comment"></span></a>
								<a href="#" title="变更作业属性"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#" title="删除作业记录"><span class="glyphicon glyphicon-trash"></span></a>
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
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>