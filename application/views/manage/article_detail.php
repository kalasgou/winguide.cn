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
					<li role="presentation"><a href="<?= base_url('console/article/view/lists') ?>">列表</a></li>
					<li role="presentation"><a href="<?= base_url('console/article/view/search') ?>">搜索</a></li>
					<li role="presentation"><a href="<?= base_url('console/article/view/create') ?>">添加</a></li>
					<li role="presentation" class="active"><a href="#">文章详情</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/article/update') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="article_id" value="<?= $detail['article_id']?>"/>
					<div class="input-group">
						<span class="input-group-addon">课程选择</span>
						<input id="course-id" type="hidden" name="course_id" value="<?= $detail['course_id']?>"/>
						<select name="course" class="form-control course-options" required>
							<option value="-1" data-course-id="-1">请选择课程模块</option>
							<?php foreach ($courses as $one):?>
							<option value="<?= $one['module']?>" data-course-id="<?= $one['id']?>"><?= $one['module_desc']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">文章栏目</span>
						<input id="module-id" type="hidden" name="module_id" value="<?= $detail['module_id']?>"/>
						<select id="module" name="module" class="form-control module-options" required>
							<option value="-1" data-module-id="-1">请选择文章栏目</option>
							<?php foreach ($modules as $one):?>
							<option value="<?= $one['module']?>" data-module-id="<?= $one['id']?>"><?= $one['module_desc']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">文章标题</span>
						<input name="title" type="text" class="form-control" placeholder="请输入文章标题" value="<?= $detail['title']?>" required/>
					</div>
					<!--<div class="input-group">
						<span class="input-group-addon">关键字</span>
						<input name="keywords" type="text" class="form-control" value="<?= $detail['keywords']?>"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">摘要</span>
						<input name="summary" type="text" class="form-control" <?= $detail['summary']?>/>
					</div>-->
					<div class="input-group">
						<span class="input-group-addon">音视频地址</span>
						<input name="multimedia_url" type="text" class="form-control" placeholder="请输入音视频资源地址" value="<?= $detail['multimedia_url']?>"/>
					</div>
					<label>注意：音频支持mp3、aac格式，视频支持h.264、xvid格式，但不支持flash，如需挂靠优酷或土豆等外部资源，请使用下面富文本编辑框内的插入视频功能。</label>
					<!--<div class="input-group">
						<span class="input-group-addon">外部链接</span>
						<input name="link" type="text" class="form-control" value="<?= $detail['link']?>"/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">附件</span>
						<input name="attachment" type="file" class="form-control" value="<?= $detail['attachment']?>1234567890"/>
					</div>-->
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~文章正文内容~~~~~~~~</div>
						<textarea name="content" class="summernote form-control"><?= $detail['content']?></textarea>
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
	  
	  var _cur_course_id = $('#course-id').val();
	  $('.course-options option[data-course-id=' + _cur_course_id + ']').attr('selected', 'true');
	  
	  var _cur_module_id = $('#module-id').val();
	  $('.module-options option[data-module-id=' + _cur_module_id + ']').attr('selected', 'true');
	  
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