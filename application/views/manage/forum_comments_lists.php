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
					<?php if ($args['visibility'] === 'public') : ?>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=public')?>">列表</a></li>
					<!--<li role="presentation" class=""><a href="<?= base_url('console/forum/view/search?visibility=public')?>">搜索</a></li>-->
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=public')?>">添加</a></li>
					<li role="presentation" class="active"><a href="#">评论</a></li>
					<?php elseif ($args['visibility'] === 'course') : ?>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/lists?visibility=course')?>">任务</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=course')?>">布置作业</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/lists')?>">题库</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/exercise/view/create')?>">新建习题</a></li>
					<li role="presentation" class="active"><a href="#">作业反馈</a></li>
					<?php endif ?>
				</ul>
			</div>
			<div class="panel-body">
				<h4>主题：<b><?= $topic['topic']?></b></h4>
				<h5>共 <b><?= $total_num?></b> 条评论</h5>
				<table class="table table-striped">
					<colspan>
						<col style="width:6%;"/>
						<col style="width:10%;"/>
						<col style="width:58%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:6%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>姓 名</th>
							<th>留 言</th>
							<th>创建时间</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($comments) > 0) { ?>
						<?php foreach($comments as $one):?>
						<tr>
							<td><?= $one['reply_id'];?></span></td>
							<td><?= $one['real_name'];?></td>
							<td><?= $one['reply'];?></td>
							<td title="<?= $one['create_time_formatted'];?>"><?= substr($one['create_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">正常</label></td>
							<td>
								<a href="#" title="删除主题记录"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						<?php endforeach;?>
						<?php } else { ?>
						<tr>
							<td colspan="6" align="center">暂无相关数据</td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
				<div class="clearfix"></div>
				<ul class="pagination pull-right">
					<?= $pagination?>
				</ul>
			</div>
		</div>
	</div>
	
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
		
    });
</script>
<?php include APPPATH .'views/manage/footer.php'?>