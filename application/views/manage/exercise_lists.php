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
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=course')?>">任务</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=course')?>">布置作业</a></li>
					<li role="presentation" class="active"><a href="#">题库</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/create')?>">新建习题</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('console/exercise/view/lists') ?>" method="get">
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
						<span class="input-group-addon">题目类型</span>
						<input id="topic" type="hidden" value="<?= $args['topic']?>">
						<select name="topic" class="form-control exercise-options" >
							<option value="">请选择题目类型</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">题库编者</span>
						<input id="admin" type="hidden" value="<?= $args['admin_id']?>">
						<select name="admin_id" class="form-control author-options" >
							<option value="">请选择题库创建人</option>
							<?php foreach ($employees as $one):?>
							<option value="<?= $one['admin_id']?>"><?= $one['username']?></option>
							<?php endforeach;?>
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
						<col style="width:8%;"/>
						<col style="width:10%;"/>
						<col style="width:8%;"/>
						<col style="width:24%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>编 者</th>
							<th>课 程</th>
							<th>题 型</th>
							<th>数 量</th>
							<th>创建时间</th>
							<th>更新时间</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($exercises) > 0) { ?>
						<?php foreach($exercises as $one):?>
						<tr>
							<td><?= $one['exercise_id'];?></span></td>
							<td><?= $one['username'];?></td>
							<td><?= strtoupper($one['course']);?></td>
							<td><?= $one['topic'];?></td>
							<td><?= $one['amount'];?> 题</td>
							<td title="<?= $one['create_time_formatted'];?>"><?= substr($one['create_time_formatted'], 0, 10);?></td>
							<td title="<?= $one['update_time_formatted'];?>"><?= substr($one['update_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/exercise/view/detail?exercise_id='.$one['exercise_id'])?>" target="_blank" title="编辑题库内容"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="#" title="变更题库属性"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#" title="删除题库记录"><span class="glyphicon glyphicon-trash"></span></a>
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
		var _cur_course = $('#course').val();
		$('.course-options option[value="' + _cur_course + '"]').attr('selected', 'true');
		
		var _cur_topic = $('#topic').val();
		if (_cur_topic !== '') {
			getExerciseTypes(_cur_course);
			$('.exercise-options option[value="' + _cur_topic + '"]').attr('selected', 'true');
		}
		
		var _cur_admin = $('#admin').val();
		$('.author-options option[value="' + _cur_admin + '"]').attr('selected', 'true');
		
		$('.course-options').change(function() {
			var _course = $(this).val();
			getExerciseTypes(_course);
		});
    });
	
	function getExerciseTypes(_course) {
		$.ajax({
			url: '<?= base_url('manage/exercise/getExerciseTypes') ?>',
			data: {course: _course},
			type: 'get',
			async: false,
			dataType: 'json',
			success: function(json) {
				var types = '<option value="">请选择题目类型</option>';
				var len = json.exercise_types.length;
				for (var i = 0; i < len; i ++) {
					types += '<option value="' + json.exercise_types[i].topic + '" data-action="' + json.exercise_types[i].action + '">' + json.exercise_types[i].topic + '</option>';
				}
				$('.exercise-options').empty();
				$('.exercise-options').append(types);
			},
			error: function() {
				alert('Network Error');
			}
		});
	}
</script>
<?php include APPPATH .'views/manage/footer.php'?>