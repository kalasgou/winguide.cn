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
				<form action="<?= base_url('manage/student/create') ?>" method="post" onsubmit="return submit_form();">
					<div class="input-group">
						<span class="input-group-addon">选择课程</span>
						<select name="course" class="form-control new-course">
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
						</select>
					</div>
					<div class="input-group has-error123">
						<span class="input-group-addon">帐号数量</span>
						<input type="text" name="amount" class="form-control new-amount" placeholder="请输入大于0的整数">
						<span class="input-group-addon">个</span>
					</div>
					<div class="input-group has-error123">
						<span class="input-group-addon">有效时长</span>
						<select name="duration_month" class="form-control duration-month">
							<option value="31">1个月</option>
							<option value="62">2个月</option>
							<option value="93">3个月</option>
							<option value="124">4个月</option>
							<option value="155">5个月</option>
							<option value="186">6个月</option>
							<option value="217">7个月</option>
							<option value="248">8个月</option>
							<option value="279">9个月</option>
							<option value="310">10个月</option>
							<option value="341">11个月</option>
							<option value="372">12个月</option>
						</select>
						<input type="text" name="duration_day" class="form-control duration-day" value="31" placeholder="请输入大于0的整数">
						<span class="input-group-addon"><p>天</p><label>(31天/月)</label></span>
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
		$('.new-amount').change(function() {
			var _amount = $('.new-amount').val();
			
			if (_amount <= 0) {
				alert('数量有误');
				return false;
			}
			
			$.ajax({
				url: '<?= base_url('manage/student/estimateAccount')?>',
				data: {amount:_amount},
				type: 'GET',
				dataType: 'json',
				success: function(json) {
					$('#start_serial').val(json.start_serial);
					$('#end_serial').val(json.end_serial);
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
		
		$('.duration-month').change(function() {
			var days = $(this).val();
			$('.duration-day').val(days);
		});	
    });
	
	function submit_form() {
		var _amount = $('.new-amount').val();
		
		if (_amount <= 0) {
			alert('数量有误');
			return false;
		}
		
		if (confirm('确定创建帐号吗？')) {
			return true;
		}
		return false;
	}
</script>
<?php include APPPATH .'views/manage/footer.php'?>