<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>
	<style type="text/css">
		.note-editable {min-height:200px;}
		.chosen-exercise {background-color:#EEEEEE; border-bottom:dotted 1px #999999;}
		.chosen-student {display:inline-block; border:dotted 1px #000000; min-width:192px; line-height:24px; padding:4px; margin:2px 0; background-color:rgb(238, 238, 238);}
		.chosen-student .glyphicon {line-height:24px;}
		.pagination {width:100%; text-align:center;}
		.pagination .active {color:grey; text-decoration:none; font-weight:bold;}
		.add-green {color:#5cb85c;}
		.minus-red {color:#D9534F;}
	</style>
	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=course')?>">任务</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=course')?>">布置作业</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/lists')?>">题库</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/create')?>">新建习题</a></li>
					<li role="presentation" class="active"><a href="#">任务详情</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<form action="<?= base_url('manage/forum/update') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="visibility" value="course" />
					<input type="hidden" name="topic_id" value="<?= $detail['topic_id']?>" />
					<input type="hidden" name="module" value="<?= $detail['module']?>" />
					<div class="input-group">
						<input id="course" type="hidden" value="<?= $detail['module']?>" />
						<span class="input-group-addon">课程选择</span>
						<select name="module" class="form-control course-options" disabled >
							<option value="">请选择课程模块</option>
							<option value="gmat">GMAT</option>
							<option value="gre">GRE</option>
							<option value="ielts">IELTS</option>
							<option value="sat">SAT</option>
							<option value="toefl">TOEFL</option>
							<option value="gaokao">高考</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">作业主题</span>
						<input name="topic" type="text" class="form-control" placeholder="请输入作业主题文字" value="<?= $detail['topic']?>" required >
					</div>
					<div class="input-group">
						<span class="input-group-addon">学生列表</span>
						<textarea name="assignment" class="form-control" placeholder="如需布置给更多学生，请在此输入学生帐号，并用英文逗号“,”隔开，例如“000001_wg,000003_wg,000008_wg”"></textarea>
					</div>
					<div style="clear:both;">已选择学生：</div>
					<?php foreach($detail['chosen_students'] as $student) : ?>
					<div class="chosen-student student-id-<?= $student['student_id']?>">
						<font><?= $student['real_name']?>（<?= $student['username']?>）</font>
						<a href="#" data-title="Remove" data-toggle="modal" data-target="#remove" data-student-id="<?= $student['student_id']?>"><span class="glyphicon glyphicon-remove pull-right"></span></a>
					</div>
					<?php endforeach ?>
					<div style="clear:both;">已选择习题：</div>
					<div class="input-group">
						<?php foreach ($detail['remark_arr'] as $one) : ?>
						<div class="chosen-exercise exercise-id-<?= $one['exercise_id']?>">
							<input type="hidden" name="exercise_id[]" value="<?= $one['exercise_id']?>">
							<input type="hidden" name="admin[]" value="<?= $one['admin']?>">
							<input type="hidden" name="subject_en[]" value="<?= $one['subject_en']?>">
							<input type="hidden" name="subject_cn[]" value="<?= $one['subject_cn']?>">
							<input type="hidden" name="amount[]" value="<?= $one['amount']?>">
							<input type="hidden" name="create_date[]" value="<?= $one['create_date']?>">
							<span>ID: <b><?= $one['exercise_id']?></b> # 编者: <b><?= $one['admin']?></b> # 课程: <b><?= strtoupper($detail['module'])?></b> # 题型: <b><?= $one['subject_cn']?></b> # 题数: 共<b><?= $one['amount']?></b>题 # @<b><?= $one['create_date']?></b></span>
							<a class="pull-right" data-exercise-id="<?= $one['exercise_id']?>" href="#" onclick="javascript:removeChosen('<?= $one['exercise_id']?>');"><span class="glyphicon glyphicon-minus-sign"></span> 移除</a>
						</div>
						<?php endforeach ?>
						<div id="bottom-up"></div>
					</div>
					<div class="input-group">
						<button class="btn btn-primary btn-block add-btn" type="button" data-title="Add" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span> 添加习题（必选）</button>
					</div>
					<div class="input-group">
						<div class="input-group-addon-instruction">~~~~~~~~作业任务简介~~~~~~~~</div>
						<textarea name="thread" class="summernote form-control" required ><?= $detail['thread']?></textarea>
					</div>
					<div class="pull-right">
						<button class="btn btn-success btn-sm" type="submit">更新</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">课程习题选择</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<span class="input-group-addon">题目类型</span>
						<select class="form-control exercise-options" required >
							<option value="">请选择题目类型</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">题库编者</span>
						<select class="form-control author-options" required>
							<option value="">请选择题库创建人</option>
							<?php foreach ($employees as $one):?>
							<option value="<?= $one['admin_id']?>"><?= $one['username']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-group">
						<div class="pull-right">
							<button class="btn btn-primary btn-sm filter" type="button">筛选</button>
						</div>
					</div>
					<div class="input-group">
						<table class="table table-striped">
							<colspan>
								<col style="width:10%;"/>
								<col style="width:20%;"/>
								<col style="width:30%;"/>
								<col style="width:10%;"/>
								<col style="width:20%;"/>
								<col style="width:10%;"/>
							</colspan>
							<thead>
								<tr>
									<th>#</th>
									<th>编者</th>
									<th>题型</th>
									<th>数量</th>
									<th>日期</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					<div class="pagination">
						
					</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-warning btn-lg ok-go" data-dismiss="modal" aria-hidden="true" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> 确定</button>
				</div>
			</div>
		<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
	</div>
	
	<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">移除作业任务</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> 移除 <b class="hints"></b>的该作业任务，你确定？</div>
				</div>
				<div class="modal-footer ">
					<button type="button" class="btn btn-success confirm" ><span class="glyphicon glyphicon-ok-sign"></span> 确定</button>
					<button type="button" class="btn btn-default cancel" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 取消</button>
				</div>
			</div>
		<!-- /.modal-content --> 
		</div>
		<!-- /.modal-dialog --> 
    </div>
</div>
</div>
<script type="text/javascript">
	var _page = 0;
	var _item = 10;
	var _link_count = 5;
	var _chosen_ids_arr = new Array();
	var _course = '';
	var _topic = '';
	var _admin_id = '';
	
	var _topic_id = $('input[name=topic_id]').val();
	var _student_id;
	
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
	  
		
		var _cur_course = $('#course').val();
		$('.course-options option[value="' + _cur_course + '"]').attr('selected', 'true');
		
		/*$('.chosen-exercise input[name="exercise_id[]"]').each(function() {
			_chosen_ids_arr.push($(this).val());
		});*/
		
		_chosen_ids_arr = $('.chosen-exercise input[name="exercise_id[]"]').map(function() {
			return $(this).val();
		}).get();
		
		$('.add-btn').click(function() {
			_page = 0;
			_course = $('.course-options').val();
			getExerciseTypes(_course);
			getExerciseSets(_course, '', '');
			
			$('#add button.filter').click(function() {
				_page = 0;
				_topic = $('.exercise-options').val();
				_admin_id = $('.author-options').val();
				
				getExerciseSets(_course, _topic, _admin_id);
			});
		});
		
		$('.chosen-student a').click(function() {
			$('#remove b.hints').html($(this).siblings().html());
			_student_id = $(this).data('student-id');
		});
		
		$('#remove button.confirm').click(function() {
			removeAssignment();
		});
    });
	
	function getExerciseTypes(_course) {
		$.ajax({
			url: '<?= base_url('manage/exercise/getExerciseTypes') ?>',
			data: {course: _course},
			type: 'get',
			async: false,
			dataType: 'json',
			success: function(json) {
				var types = '<option value="">请选择题目类型</option>';
				var len = json.exercise_types.length;
				for (var i = 0; i < len; i ++) {
					types += '<option value="' + json.exercise_types[i].topic + '" data-action="' + json.exercise_types[i].action + '">' + json.exercise_types[i].topic + '</option>';
				}
				$('.exercise-options').empty();
				$('.exercise-options').append(types);
			},
			error: function() {
				alert('Network Error');
			}
		});
	}
	
	function getExerciseSets(_course, _topic, _admin_id) {
		$.ajax({
			url: '<?= base_url('manage/exercise/lists') ?>',
			data: {course: _course, topic:_topic, admin_id:_admin_id, item:_item, page:_page},
			type: 'get',
			async: false,
			dataType: 'json',
			success: function(json) {
				var sets = '';
				var _total_sets = json.total_sets;
				var len = json.exercises.length;
				if (len > 0) {
					for (var i = 0; i < len; i ++) {
						sets += '<tr>' + 
									'<td>' + json.exercises[i]['exercise_id'] + '</td>' + 
									'<td>' + json.exercises[i]['username'] + '</td>' +
									'<td data-action="' + json.exercises[i]['subject'] + '">' + json.exercises[i]['topic'] + '</td>' +
									'<td>' + json.exercises[i]['amount'] + '</td>' +
									'<td>' + json.exercises[i]['create_time_formatted'] + '</td>' +
									'<td>'; 
						if (_chosen_ids_arr.indexOf(json.exercises[i]['exercise_id']) === -1) {
							sets += '<a class="add-green" data-title="Add" href="#"><span class="glyphicon glyphicon-plus-sign"></span></a></td></tr>';
						} else {
							sets += '<a  class="minus-red" data-title="Remove" href="#"><span class="glyphicon glyphicon-minus-sign"></span></a></td></tr>';
						}
					}
					
					$('#add table tbody').empty();
					$('#add table tbody').append(sets);
					
					++ _page;
					getPagination(_page, _link_count, _item, _total_sets)
					
					$('#add td a').click(function() {
						var _cur_course = _course.toUpperCase();
						var _exercise_id = $($(this).parent().siblings('td')[0]).html();
						var _username = $($(this).parent().siblings('td')[1]).html();
						var _action = $($(this).parent().siblings('td')[2]).data('action');
						var _topic = $($(this).parent().siblings('td')[2]).html();
						var _amount = $($(this).parent().siblings('td')[3]).html();
						var _create_date = $($(this).parent().siblings('td')[4]).html();
						
						switch ($(this).data('title')) {
							case 'Add':
										$(this).html('<span class="glyphicon glyphicon-minus-sign"></span>');
										$(this).data('title', 'Remove');
										$(this).attr('class', 'minus-red');
										var chosen = '<div class="chosen-exercise exercise-id-' + _exercise_id + '">' +
														'<input type="hidden" name="exercise_id[]" value="' + _exercise_id + '" />' +
														'<input type="hidden" name="admin[]" value="' + _username + '" />' +
														'<input type="hidden" name="subject_en[]" value="' + _action + '" />' +
														'<input type="hidden" name="subject_cn[]" value="' + _topic + '" />' +
														'<input type="hidden" name="amount[]" value="' + _amount + '" />' + 
														'<input type="hidden" name="create_date[]" value="' + _create_date + '" />' + 
														'<span>ID: <b>' + _exercise_id + '</b> # 编者: <b>' + _username + '</b> # 课程: <b>' + _cur_course + '</b> # 题型: <b>' + _topic + '</b> # 题数: 共<b>' + _amount + '</b>题 # @<b>' + _create_date + '</b></span>' +
														'<a class="pull-right" data-exercise-id="' + _exercise_id + '" href="#" onclick="javascript:removeChosen(\'' + _exercise_id + '\');"><span class="glyphicon glyphicon-minus-sign"></span> 移除</a>' +
													'</div>';
										$('#bottom-up').before(chosen);
										
										_chosen_ids_arr.push(_exercise_id);
										
										break;
							case 'Remove':
										$(this).html('<span class="glyphicon glyphicon-plus-sign"></span>');
										$(this).data('title', 'Add');
										$(this).attr('class', 'add-green');
										$('.exercise-id-' + _exercise_id).remove();
										
										_chosen_ids_arr[_chosen_ids_arr.indexOf(_exercise_id)] = '0';
										
										break;
						}
					});
				} else {
					sets = '<tr><td colspan="6" align="center">暂无相关数据</td></tr>';
					
					$('#add table tbody').empty();
					$('#add table tbody').append(sets);
				}
			},
			error: function() {
				alert('Network Error');
			}
		});
	}
	
	function removeChosen(_exercise_id) {
		$('.exercise-id-' + _exercise_id).remove();
		_chosen_ids_arr[_chosen_ids_arr.indexOf(_exercise_id)] = '0';
	}
	
	function getPagination(curr_index, link_count, per_page, total_item) {
		var page_count = Math.ceil(total_item / per_page);
		var start = Math.max(1, curr_index - parseInt(link_count/2));
　　	var end = Math.min(page_count, start + link_count - 1);
　　	start = Math.max(1, end - link_count + 1);
		
		//return [start, end];
		var pagination = '';
		if (curr_index > 1) {
			pagination += ' <a href="#" data-page="' + (curr_index - 2) + '"><上一页</a> ';
		}
		for (var i = start; i <= end; i++) {
			if (_page === i) {
				pagination += ' <a class="active" data-page="' + i + '">' + i + '</a> ';
			} else {
				pagination += ' <a href="#" data-page="' + (i - 1) + '">' + i + '</a> ';
			}
			
		}
		if (curr_index < page_count) {
			pagination += ' <a href="#" data-page="' + (curr_index) + '">下一页></a> ';
		}
		
		$('#add div.pagination').empty();
		$('#add div.pagination').append(pagination);
		
		$('.pagination a').click(function() {
			_page = $(this).data('page');
			getExerciseSets(_course, _topic, _admin_id);
		});
	}
	
	function removeAssignment() {
		$.ajax({
			url: '<?= base_url('manage/forum/trashAssignment') ?>',
			data: {student_id: _student_id, topic_id:_topic_id},
			type: 'post',
			dataType: 'json',
			success: function(json) {
				alert(json.msg);
				if (json.code === 0) {
					$('.student-id-' + _student_id).remove();
				}
			},
			error: function() {
				alert('Network Error');
			}
		});
	}
</script>
<?php include APPPATH .'views/manage/footer.php'?>