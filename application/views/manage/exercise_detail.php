<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=course')?>">任务</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=course')?>">布置作业</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/lists')?>">题库</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/create')?>">新建习题</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/exercise/create') ?>" method="post" enctype="multipart/form-data">
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<select name="course" class="form-control course-options" data-course="<?= $detail['course']?>" required>
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
						<input id="hidden-exercise-action" name="exercise_action" type="hidden" required />
						<select name="exercise_type" class="form-control exercise-options" data-exercise="<?= $detail['topic']?>" required >
							<option value="-1">请选择题目类型</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">题目选择</span>
						<textarea name="exercise_ids" type="text" class="form-control" required ><?= $detail['numbers']?></textarea>
					</div>
					<div class="pull-right">
						<button class="btn btn-default btn-sm" type="submit">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var _cur_course = $('.course-options').data('course');
		$('.course-options option[value="' + _cur_course + '"]').attr('selected', 'true');
		
		getExerciseTypes(_cur_course);
		var _cur_topic = $('.exercise-options').data('exercise');
		$('.exercise-options option[value="' + _cur_topic + '"]').attr('selected', 'true');
    });
	
	function getExerciseTypes(_course) {
		$.ajax({
			url: '<?= base_url('manage/exercise/getExerciseTypes') ?>',
			data: {course: _course},
			type: 'get',
			async: false,
			dataType: 'json',
			success: function(json) {
				var types = '<option value="-1" data-course-id="-1">请选择题目类型</option>';
				var len = json.exercise_types.length;
				for (var i = 0; i < len; i ++) {
					types += '<option value="' + json.exercise_types[i].topic + '" data-action="' + json.exercise_types[i].action + '">' + json.exercise_types[i].topic + '</option>';
				}
				$('.exercise-options').empty();
				$('.exercise-options').append(types);
				//var _cur_topic = $('.exercise-options').data('exercise');
				//$('.exercise-options option[value="' + _cur_topic + '"]').attr('selected', 'true');
			},
			error: function() {
				alert('Network Error');
			}
		});
	}
</script>
<?php include APPPATH .'views/manage/footer.php'?>