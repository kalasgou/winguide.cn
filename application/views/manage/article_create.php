<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/article/view/lists') ?>">列表</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/article/view/search') ?>">搜索</a></li>
					<li role="presentation" class="active"><a href="#">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/article/create') ?>" method="post" enctype="multipart/form-data">
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
						<input id="course-id" type="hidden" name="course_id" value="-1"/>
						<select name="course" class="form-control course-options" required>
							<option value="-1" data-course-id="-1">请选择课程模块</option>
							<?php foreach ($module as $one):?>
							<option value="<?= $one['module']?>" data-course-id="<?= $one['id']?>"><?= $one['module_desc']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">文章栏目</span>
						<input id="module-id" type="hidden" name="module_id" value="-1"/>
						<select id="module" name="module" class="form-control module-options" required>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">文章标题</span>
						<input name="title" type="text" class="form-control" required/>
					</div>
					<!--<div class="input-group">
						<span class="input-group-addon">关键字</span>
						<input name="keywords" type="text" class="form-control"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">摘要</span>
						<input name="summary" type="text" class="form-control"/>
					</div>-->
					<div class="input-group">
						<span class="input-group-addon">音视频地址</span>
						<input name="multimedia_url" type="text" class="form-control"/>
					</div>
					<!--<div class="input-group">
						<span class="input-group-addon">外部链接</span>
						<input name="link" type="text" class="form-control"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">附件</span>
						<input name="attachment" type="file" class="form-control"/>
					</div>-->
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~文章正文内容~~~~~~~~</div>
						<textarea name="content" class="summernote form-control">
						
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
	  
		$('.course-options').change(function() {
			var _upper = $(this).find('option:selected').data('course-id'); 
			$('#course-id').val(_upper);
			$.ajax({
				url: '<?= base_url('manage/article/getModules') ?>',
				data: {upper: _upper},
				type: 'get',
				dataType: 'json',
				success: function(json) {
					var modules = '<option value="-1" data-course-id="-1">请选择文章栏目</option>';
					var len = json.modules.length;
					for (var i = 0; i < len; i ++) {
						modules += '<option value="' + json.modules[i].module + '" data-module-id="' + json.modules[i].id + '">' + json.modules[i].module_desc + '</option>';
					}
					$('.module-options').empty();
					$('.module-options').append(modules);
				},
				error: function() {
					alert('Network Error');
				}
			});
		});
	  
		$('.module-options').change(function() {
			var _module_id = $(this).find('option:selected').data('module-id'); 
			$('#module-id').val(_module_id);
		});
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>