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
				<p><span class="glyphicon glyphicon"></span> Article ID: <?= $detail['article_id']?></p>
				<p><span class="glyphicon glyphicon"></span> UUID: <?= $detail['uuid']?></p>
				<p><span class="glyphicon glyphicon"></span> Course: <?= $detail['course']?></p>
				<p><span class="glyphicon glyphicon"></span> Module: <?= $detail['module']?></p>
				<p><span class="glyphicon glyphicon"></span> Recommend: <?= $detail['recommend']?></p>
				<p><span class="glyphicon glyphicon"></span> Cover: <?= $detail['cover']?></p>
				<p><span class="glyphicon glyphicon"></span> Title: <?= $detail['title']?></p>
				<p><span class="glyphicon glyphicon"></span> Keywords: <?= $detail['keywords']?></p>
				<p><span class="glyphicon glyphicon"></span> Summary: <?= $detail['summary']?></p>
				<p><span class="glyphicon glyphicon"></span> Multimedia_url: <?= $detail['multimedia_url']?></p>
				<p><span class="glyphicon glyphicon"></span> Link: <?= $detail['link']?></p>
				<p><span class="glyphicon glyphicon"></span> Attachment: <?= $detail['attachment']?></p>
				<p><span class="glyphicon glyphicon"></span> Create Time: <?= $detail['create_time']?></p>
				<p><span class="glyphicon glyphicon"></span> Content: <?= $detail['content']?></p>
				<div class="clearfix"></div>
				
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