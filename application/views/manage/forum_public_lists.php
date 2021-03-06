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
					<li role="presentation" class="active"><a href="#">列表</a></li>
					<!--<li role="presentation" class=""><a href="<?= base_url('console/forum/view/search?visibility=public')?>">搜索</a></li>-->
					<li role="presentation" class=""><a href="<?= base_url('console/forum/view/create?visibility=public')?>">添加</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<colspan>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:30%;"/>
						<!--<col style="width:5%;"/>-->
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
						<col style="width:10%;"/>
					</colspan>
					<thead>
						<tr>
							<th>#</th>
							<th>创建人</th>
							<th>课 程</th>
							<th>话 题</th>
							<!--<th>置 顶</th>-->
							<th>创建时间</th>
							<th>更新时间</th>
							<th>状 态</th>
							<th>操 作</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($topics) > 0) { ?>
						<?php foreach($topics as $one):?>
						<tr>
							<td><span data-uuid="<?= $one['uuid']?>"><?= $one['topic_id'];?></span></td>
							<td><?= $one['username'];?></td>
							<td><?= strtoupper($one['module']);?></td>
							<td><?= $one['topic'];?></td>
							<!--<td><?= $one['thread'];?></td>-->
							<!--<td><?= $one['recommend'];?></td>-->
							<td title="<?= $one['create_time_formatted'];?>"><?= substr($one['create_time_formatted'], 0, 10);?></td>
							<td title="<?= $one['update_time_formatted'];?>"><?= substr($one['update_time_formatted'], 0, 10);?></td>
							<td><label class="label label-success">有效</label></td>
							<td>
								<a href="<?= base_url('console/forum/view/detail?topic_id='.$one['topic_id'])?>" target="_blank" title="编辑主题内容"><span class="glyphicon glyphicon-edit" title=""></span></a>
								<a href="<?= base_url('console/forum/view/comments?visibility=public&topic_id='.$one['topic_id'])?>" target="_blank" title="浏览讨论留言"><span class="glyphicon glyphicon-comment"></span></a>
								<!--<a href="#" title="变更主题属性"><span class="glyphicon glyphicon-wrench"></span></a>
								<a href="#" title="删除主题记录"><span class="glyphicon glyphicon-trash"></span></a>-->
							</td>
						</tr>
						<?php endforeach;?>
						<?php } else { ?>
						<tr>
							<td colspan="8" align="center">暂无相关数据</td>
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