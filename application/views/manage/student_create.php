<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>

	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/lists') ?>">列表</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>
					<li role="presentation" class="active"><a href="#">增添</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/login/test') ?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">选择课程</span>
						<select class="form-control">
							<option value="">GMAT</option>
							<option value="">GRE</option>
							<option value="">IELTS</option>
							<option value="">SAT</option>
							<option value="">TOEFL</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">帐号数量</span>
						<input type="text" class="form-control">
						<span class="input-group-addon">个</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">开始</span>
						<input type="text" class="form-control">
						<span class="input-group-addon">_wg</span>
					</div>
					<div class="input-group">
						<span class="input-group-addon">结束</span>
						<input type="text" class="form-control">
						<span class="input-group-addon">_wg</span>
					</div>
					
					<button class="btn btn-default pull-right" type="submit">提交</button>
				</form>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200,
        tabsize: 2,
		lang: 'zh-CN',
		/*toolbar: [
  		    ['style', ['bold', 'italic', 'underline', 'clear']],
  		    ['color', ['color']],
  		    ['para', ['ul', 'ol', 'paragraph']],
  		    ['height', ['height']],
  		    ['table', ['table']],
  		    ['insert', ['video']]
  		  ],*/
		styleWithSpan: false,
        codemirror: {
          theme: 'monokai'
        }
      });
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>