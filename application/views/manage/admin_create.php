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
					<li role="presentation" class=""><a href="<?= base_url('console/admin/view/lists') ?>">列表</a></li>
					<!--<li role="presentation" class=""><a href="<?= base_url('console/admin/view/search') ?>">搜索</a></li>-->
					<li role="presentation" class="active"><a href="#">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/admin/register') ?>" method="post" onsubmit="return submit_form();">
					<div class="input-group">
						<span class="input-group-addon">帐号类型</span>
						<select name="privilege" class="form-control" required />
							<option value="">请选择帐号类型</option>
							<option value="<?= TEACHER?>">老师</option>
							<option value="<?= AGENCY?>">中介</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">邮箱地址</span>
						<input type="email" name="email" class="form-control" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon">帐号昵称</span>
						<input type="text" name="username" class="form-control" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon">登录密码</span>
						<input id="inputPassword" type="password" name="password" class="form-control" required />
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
	function submit_form() {
		var password = $('#inputPassword').val();
		$('#inputPassword').val(hex_md5(password));
		return true;
	}
	
    $(document).ready(function() {
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>