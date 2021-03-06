<style type="text/css">
h1.page-header {
    margin-top: -5px;
}

.sidebar {
	padding-left: 0;
}

.wrap {
	min-height: 100%;
	height: auto !important;
	height: 100%;
	padding-bottom: 24px;
}

.main-container { 
	background: #FFF;
	padding-top: 15px;
	margin-top: -20px;
}

:focus {
	outline: none;
}

.side-menu {
	position: relative;
	width: 100%;
	height: 100%;
	background-color: #f8f8f8;
	border-right: 1px solid #e7e7e7;
}
.side-menu .navbar {
	border: none;
}
.side-menu .navbar-header {
	width: 100%;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu .navbar-nav .active a {
	background-color: transparent;
	margin-right: -1px;
	border-right: 5px solid #e7e7e7;
}
.side-menu .navbar-nav li {
	display: block;
	width: 100%;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu .navbar-nav li a {
	padding: 15px;
}
.side-menu .navbar-nav li a .glyphicon {
	padding-right: 10px;
}
.side-menu #dropdown {
	border: 0;
	margin-bottom: 0;
	border-radius: 0;
	background-color: transparent;
	box-shadow: none;
}
.side-menu #dropdown .caret {
	float: right;
	margin: 9px 5px 0;
}
.side-menu #dropdown .indicator {
	float: right;
}
.side-menu #dropdown > a {
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #dropdown .panel-body {
	padding: 0;
	background-color: #f3f3f3;
}
.side-menu #dropdown .panel-body .navbar-nav {
	width: 100%;
}
.side-menu #dropdown .panel-body .navbar-nav li {
	padding-left: 15px;
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #dropdown .panel-body .navbar-nav li:last-child {
	border-bottom: none;
}
.side-menu #dropdown .panel-body .panel > a {
	margin-left: -20px;
	padding-left: 35px;
}
.side-menu #dropdown .panel-body .panel-body {
	margin-left: -15px;
}
.side-menu #dropdown .panel-body .panel-body li {
	padding-left: 30px;
}
.side-menu #dropdown .panel-body .panel-body li:last-child {
	border-bottom: 1px solid #e7e7e7;
}
.side-menu #search-trigger {
	background-color: #f3f3f3;
	border: 0;
	border-radius: 0;
	position: absolute;
	top: 0;
	right: 0;
	padding: 15px 18px;
}
.side-menu .brand-name-wrapper {
	min-height: 50px;
}
.side-menu .brand-name-wrapper .navbar-brand {
	display: block;
}
.side-menu #search {
	position: relative;
	z-index: 1000;
}
.side-menu #search .panel-body {
	padding: 0;
}
.side-menu #search .panel-body .navbar-form {
	padding: 0;
	padding-right: 50px;
	width: 100%;
	margin: 0;
	position: relative;
	border-top: 1px solid #e7e7e7;
}
.side-menu #search .panel-body .navbar-form .form-group {
	width: 100%;
	position: relative;
}
.side-menu #search .panel-body .navbar-form input {
	border: 0;
	border-radius: 0;
	box-shadow: none;
	width: 100%;
	height: 50px;
}
.side-menu #search .panel-body .navbar-form .btn {
	position: absolute;
	right: 0;
	top: 0;
	border: 0;
	border-radius: 0;
	background-color: #f3f3f3;
	padding: 15px 18px;
}
/* Main body section */
.side-body {
	margin-left: 310px;
}
/* small screen */
@media (max-width: 768px) {
	.side-menu {
		position: relative;
		width: 100%;
		height: 0;
		border-right: 0;
	}

	.side-menu .navbar {
		z-index: 999;
		position: relative;
		height: 0;
		min-height: 0;
		background-color:none !important;
		border-color: none !important;
	}
	.side-menu .brand-name-wrapper .navbar-brand {
		display: inline-block;
	}
	/* Slide in animation */
	@-moz-keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@-webkit-keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@keyframes slidein {
		0% {
			left: -300px;
		}
		100% {
			left: 10px;
		}
	}
	@-moz-keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	@-webkit-keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	@keyframes slideout {
		0% {
			left: 0;
		}
		100% {
			left: -300px;
		}
	}
	/* Slide side menu*/
	/* Add .absolute-wrapper.slide-in for scrollable menu -> see top comment */
	.side-menu-container > .navbar-nav.slide-in {
		-moz-animation: slidein 300ms forwards;
		-o-animation: slidein 300ms forwards;
		-webkit-animation: slidein 300ms forwards;
		animation: slidein 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	.side-menu-container > .navbar-nav {
		/* Add position:absolute for scrollable menu -> see top comment */
		position: fixed;
		left: -300px;
		width: 300px;
		top: 43px;
		height: 100%;
		border-right: 1px solid #e7e7e7;
		background-color: #f8f8f8;
		overflow: auto;
		-moz-animation: slideout 300ms forwards;
		-o-animation: slideout 300ms forwards;
		-webkit-animation: slideout 300ms forwards;
		animation: slideout 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	@-moz-keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@-webkit-keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@keyframes bodyslidein {
		0% {
			left: 0;
		}
		100% {
			left: 300px;
		}
	}
	@-moz-keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	@-webkit-keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	@keyframes bodyslideout {
		0% {
			left: 300px;
		}
		100% {
			left: 0;
		}
	}
	/* Slide side body*/
	.side-body {
		margin-left: 5px;
		margin-top: 70px;
		position: relative;
		-moz-animation: bodyslideout 300ms forwards;
		-o-animation: bodyslideout 300ms forwards;
		-webkit-animation: bodyslideout 300ms forwards;
		animation: bodyslideout 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	.body-slide-in {
		-moz-animation: bodyslidein 300ms forwards;
		-o-animation: bodyslidein 300ms forwards;
		-webkit-animation: bodyslidein 300ms forwards;
		animation: bodyslidein 300ms forwards;
		-webkit-transform-style: preserve-3d;
		transform-style: preserve-3d;
	}
	/* Hamburger */
	.navbar-toggle-sidebar {
		border: 0;
		float: left;
		padding: 18px;
		margin: 0;
		border-radius: 0;
		background-color: #f3f3f3;
	}
	/* Search */
	#search .panel-body .navbar-form {
		border-bottom: 0;
	}
	#search .panel-body .navbar-form .form-group {
		margin: 0;
	}
	.side-menu .navbar-header {
		/* this is probably redundant */
		position: fixed;
		z-index: 3;
		background-color: #f8f8f8;
	}
	/* Dropdown tweek */
	#dropdown .panel-body .navbar-nav {
		margin: 0;
	}
}
</style>
<script type="text/javascript">
$(function () {
	var hover = $('#hover').val();
	$('#' + hover + '_nav').attr('class', 'active');
	
	/*if (hover.indexOf('forum') > -1) {
		$('#dropdown').removeClass('collapsed').attr('aria-expanded', 'true');
		$('#dropdown-lvl1').addClass('in').attr('aria-expanded', 'true');
	}*/
	
  	$('.navbar-toggle-sidebar').click(function () {
  		$('.navbar-nav').toggleClass('slide-in');
  		$('.side-body').toggleClass('body-slide-in');
  		$('#search').removeClass('in').addClass('collapse').slideUp(200);
  	});

  	$('#search-trigger').click(function () {
  		$('.navbar-nav').removeClass('slide-in');
  		$('.side-body').removeClass('body-slide-in');
  		$('.search-input').focus();
  	});
  });
</script>
<div class="wrap">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">菜单</button>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= base_url()?>" target="_blank">
					WinGuide赢凯
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
				<!--<form class="navbar-form navbar-left" method="GET" role="search">
					<div class="form-group">
						<input type="text" name="q" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</form>-->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= base_url('manage/application/form')?>" target="_blank">
						<span class="glyphicon glyphicon-check"></span> 课程申请
						</a></li>
					<li class="dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="glyphicon glyphicon-user"></span>
						<?php if (!empty($_SESSION['admin'])) { 
								echo $_SESSION['admin']['username'];
							} else {
								echo 'Forbidden';
							} 
						?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<!--<li class="dropdown-header">设置</li>-->
							<!--<li class=""><a href="#"><span class="glyphicon glyphicon-cog"></span> Other Link</a></li>
							<li class=""><a href="#"><span class="glyphicon glyphicon-cog"></span> Other Link</a></li>
							<li class=""><a href="#"><span class="glyphicon glyphicon-cog"></span> Other Link</a></li>
							<li class="divider"></li>-->
							<li><a href="<?= base_url('console/admin/view/detail')?>"><span class="glyphicon glyphicon-user"></span> 编辑帐号</a></li>
							<li><a href="<?= base_url('console/admin/view/resetPswd')?>"><span class="glyphicon glyphicon-lock"></span> 修改密码</a></li>
							<li class="divider">
							<li><a href="<?= base_url('manage/admin/logout')?>"><span class="glyphicon glyphicon-off"></span> 退出系统</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="container-fluid main-container">
		<div class="col-md-2 sidebar">
			<div class="row">
				<!-- uncomment code for absolute positioning tweek see top comment in css -->
				<div class="absolute-wrapper"> </div>
				<!-- Menu -->
				<div class="side-menu">
					<nav class="navbar navbar-default" role="navigation">
						<!-- Main Menu -->
						<div class="side-menu-container">
							<input id="hover" type="hidden" value="<?= $hover ?>" />
							<ul class="nav navbar-nav">
								<li id="article_nav"><a href="/console/article"><span class="glyphicon glyphicon-globe"></span> 文章仓库</a></li>
								<li id="student_nav"><a href="/console/student"><span class="glyphicon glyphicon-education"></span> 付费帐号</a></li>
								<li id="user_nav"><a href="/console/user"><span class="glyphicon glyphicon-sunglasses"></span> 普通帐号</a></li>
								<li id="forum_public_nav"><a href="/console/forum?visibility=public"><span class="glyphicon glyphicon-bullhorn"></span> 讨论留言</a></li>
								<li id="forum_course_nav"><a href="/console/forum?visibility=course"><span class="glyphicon glyphicon-book"></span> 课程任务</a></li>
								<!-- Dropdown-->
								<!--<li class="panel panel-default" id="dropdown">
									<a data-toggle="collapse" href="#dropdown-lvl1">
										<span class="glyphicon glyphicon-edit"></span> 讨论留言 <span class="caret"></span>
									</a>-->

									<!-- Dropdown level 1 -->
									<!--<div id="dropdown-lvl1" class="panel-collapse collapse">
										<div class="panel-body">
											<ul class="nav navbar-nav">
												<li id="forum_public_nav"><a href="/console/forum?visibility=public"><span class="glyphicon glyphicon-bullhorn"></span> 全站论坛</a></li>
												<li id="forum_course_nav"><a href="/console/forum?visibility=course"><span class="glyphicon glyphicon-book"></span> 课程任务</a></li>-->
												<!--<li><a href="#">Link</a></li>

												 Dropdown level 2 
												<li class="panel panel-default" id="dropdown">
													<a data-toggle="collapse" href="#dropdown-lvl2">
														<span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
													</a>
													<div id="dropdown-lvl2" class="panel-collapse collapse">
														<div class="panel-body">
															<ul class="nav navbar-nav">
																<li><a href="#">Link</a></li>
																<li><a href="#">Link</a></li>
																<li><a href="#">Link</a></li>
															</ul>
														</div>
													</div>
												</li>-->
											<!--</ul>
										</div>
									</div>
								</li>-->
								
								<li id="admin_nav"><a href="/console/admin"><span class="glyphicon glyphicon-user"></span> 后台帐号</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-hdd"></span> 日志记录</a></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</nav>
				</div>
			</div>  		
		</div>