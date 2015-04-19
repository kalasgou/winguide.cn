<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility='.$_GET['visibility']) ?>">列表</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/search?visibility='.$_GET['visibility']) ?>">搜索</a></li>
					<li role="presentation" class="active"><a href="#">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/forum/create') ?>" method="post" enctype="multipart/form-data">
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<select name="module" class="form-control" required>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">论坛版块</span>
						<select id="visibility-option" name="visibility" class="form-control" disabled required>
							<option value="public">全站论坛</option>
							<option value="course">课程任务</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">讨论主题</span>
						<input name="topic" type="text" class="form-control" required>
					</div>
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~主题正文内容~~~~~~~~</div>
						<textarea name="thread" class="summernote form-control" required>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</textarea>
					</div>
					<button class="btn btn-default pull-right" type="submit">提交</button>
				</form>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
	var _visibility = getQueryString('visibility');
	$('#visibility-option option[value=' + _visibility + ']').attr('selected', 'true');
    
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