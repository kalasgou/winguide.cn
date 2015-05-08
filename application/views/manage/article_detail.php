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
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/article/update') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="article_id" value="<?= $detail['article_id']?>"/>
					<div class="input-group">
						<span class="input-group-addon">课程模块</span>
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
						<input name="title" type="text" class="form-control" value="<?= $detail['title']?>" required/>
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
						<input name="multimedia_url" type="text" class="form-control" value="<?= $detail['multimedia_url']?>"/>
					</div>
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
						<textarea name="content" class="summernote form-control">
						<?= $detail['content']?>
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
	  
	  var _cur_course_id = $('#course-id').val();
	  $('.course-options option[data-course-id=' + _cur_course_id + ']').attr('selected', 'true');
	  
	  var _cur_module_id = $('#module-id').val();
	  $('.module-options option[data-module-id=' + _cur_module_id + ']').attr('selected', 'true');
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>