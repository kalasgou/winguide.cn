<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility='.$visibility)?>">列表</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/search?visibility='.$visibility)?>">搜索</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility='.$visibility)?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/forum/update') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="topic_id" value="<?= $detail['topic_id']?>"/>
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<input type="hidden" id="cur-module" value="<?= $detail['module']?>"/>
						<select id="module-option" name="module" class="form-control" required>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">论坛版块</span>
						<input type="hidden" id="cur-visibility" value="<?= $detail['visibility']?>"/>
						<select id="visibility-option" name="visibility" class="form-control" required>
							<option value="public">全站论坛</option>
							<option value="course">课程任务</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">讨论主题</span>
						<input name="topic" type="text" class="form-control" value="<?= $detail['topic']?>" required>
					</div>
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~主题正文内容~~~~~~~~</div>
						<textarea name="thread" class="summernote form-control" required>
						<?= $detail['thread']?>
						</textarea>
					</div>
					<button class="btn btn-success pull-right" type="submit">提交</button>
				</form>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
	var _module = $('#cur-module').val();
	var _visibility = $('#cur-visibility').val();
	$('#module-option option[value=' + _module + ']').attr('selected', 'true');
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