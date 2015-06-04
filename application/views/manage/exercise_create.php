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
					<li role="presentation" class="active"><a href="#">新建习题</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/exercise/create') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="visibility" value="course" required />
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<select name="course" class="form-control course-options" required>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
							<option value="gaokao">高考</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">练习题型</span>
						<select id="visibility-option" name="exercise_type" class="form-control" required >
							<option value="">全站论坛</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">题目选择</span>
						<textarea name="exercise_ids" type="text" class="form-control" required >
						</textarea>
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
		$
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>