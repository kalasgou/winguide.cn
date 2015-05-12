<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>

	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/lists') ?>">学员</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/accounts') ?>">帐号</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>
					<li role="presentation" class="active"><a href="#">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/student/create') ?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">选择课程</span>
						<select name="course" class="form-control">
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">帐号数量</span>
						<input type="text" name="amount" class="form-control">
						<span class="input-group-addon">个</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">起始</span>
						<input id="start_serial" type="text" class="form-control" readonly placeholder="预计帐号起始编码">
						<span class="input-group-addon">_wg</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">结束</span>
						<input id="end_serial" type="text" class="form-control" readonly placeholder="预计帐号结束编码">
						<span class="input-group-addon">_wg</span>
					</div>
					<div class="pull-right">
						<button class="btn btn-success btn-sm" type="submit">提交</button>
					</div>
				</form>
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