<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=public')?>">列表</a></li>
					<!--<li role="presentation" class=""><a href="<?= base_url('console/forum/view/search?visibility=public')?>">搜索</a></li>-->
					<li role="presentation" class="active"><a href="#">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/forum/create') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="visibility" value="public" required />
					<div class="input-group">
						<span class="input-group-addon">课程选择</span>
						<select name="module" class="form-control" required>
							<option value="">请选择课程模块</option>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
							<option value="gaokao">高考</option>
						</select>
					</div>
					<!--<div class="input-group">
						<span class="input-group-addon">论坛版块</span>
						<select id="visibility-option" name="visibility" class="form-control" required>
							<option value="public">全站论坛</option>
							<option value="course">课程任务</option>
						</select>
					</div>-->
					<div class="input-group">
						<span class="input-group-addon">讨论主题</span>
						<input name="topic" type="text" class="form-control" placeholder="请填写讨论主题" required>
					</div>
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~主题正文内容~~~~~~~~</div>
						<textarea name="thread" class="summernote form-control" required></textarea>
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
      $('.summernote').summernote({
        height: 300,
        tabsize: 2,
		lang: 'zh-CN',
		toolbar: [
  		    ['misc', ['undo', 'redo']],
			['fontname', ['fontname']],
  		    ['style', ['style']],
  		    ['fontsize', ['fontsize']],
			['height', ['height']],
  		    ['style', ['bold', 'italic', 'underline']],
  		    ['style', ['strikethrough', 'superscript', 'subscript']],
  		    ['style', ['clear']],
  		    ['color', ['color']],
  		    ['para', ['ul', 'ol', 'paragraph']],
  		    ['table', ['table']],
  		    ['hr', ['hr']],
  		    ['insert', ['picture', 'link', 'video']],
  		    ['misc', ['fullscreen', 'codeview', 'help']],
  		  ],
		styleWithSpan: false,
        codemirror: {
          theme: 'monokai'
        }
      });
	  
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>