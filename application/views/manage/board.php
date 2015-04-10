<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>

	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				Dashboard
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/login/test') ?>" method="post">
					<div class="input-group">
						<span class="input-group-addon">Category</span>
						<select class="form-control">
							<option value="">GMAT</option>
							<option value="">GRE</option>
							<option value="">IELTS</option>
							<option value="">SAT</option>
							<option value="">TOEFL</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Module</span>
						<select class="form-control">
							<option value="">GMAT 123</option>
							<option value="">GRE 123</option>
							<option value="">IELTS 123 </option>
							<option value="">SAT 123</option>
							<option value="">TOEFL 123</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Title</span>
						<input type="text" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">Keywords</span>
						<input type="text" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">Summary</span>
						<input type="text" class="form-control">
					</div>
					
					<div class="input-group">
						<span class="input-group-addon">Video URL</span>
						<input type="text" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">Link</span>
						<input type="text" class="form-control">
					</div>
					<div class="input-group">
						<span class="input-group-addon">123</span>
						<input type="text" class="form-control">
					</div>
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~Content~~~~~~~~</div>
						<textarea name="content" class="summernote form-control">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</textarea>
					</div>
					<button class="btn btn-default" type="submit">提交</button>
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