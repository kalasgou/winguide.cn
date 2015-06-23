<?php include APPPATH .'views/manage/header.php'?>

<?php include APPPATH .'views/manage/navbar.php'?>

<link rel="stylesheet" href="/www/form.css">

	<div class="col-md-10 content">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/lists') ?>">学员</a></li>
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/accounts') ?>">帐号</a></li>
					<!--<li role="presentation" class=""><a href="<?= base_url('console/student/view/search') ?>">搜索</a></li>-->
					<li role="presentation" class=""><a href="<?= base_url('console/student/view/create') ?>">添加</a></li>
					<li role="presentation" class="active"><a href="#">学生详情</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="formDiv">			
			        <div class="form">
			        	<form action="" id="form">
			        		
			        		<!--第一行 姓名-->
							<input class="t1_1" name="basic:real_name" type="text" value="<?= $detail['basic']['real_name']?>" />
							<input class="t1_2" name="basic:used_name" type="text" value="<?= $detail['basic']['used_name']?>" />
							<input class="t1_3" name="basic:birthday" type="text" value="<?= $detail['basic']['birthday']?>" />
							<input class="t1_4" name="basic:sex" type="text" value="<?= $detail['basic']['sex']?>" />
							
							<!--第二行 Username-->
							<input class="t2_1" name="student:username" type="text" value="<?= $detail['student']['username']?>" disabled/>
							<input class="t2_2" name="student:password" type="password" id="password" value="********" disabled/>
							<input class="t2_3" name="basic:born_city" type="text" value="<?= $detail['basic']['born_city']?>" />
							<input class="t2_4" name="basic:marriage" type="text" value="<?= $detail['basic']['marriage']?>" />

							<!--第三行 家庭常住地址-->
							<input class="t3_1" name="basic:family_addr" type="text" value="<?= $detail['basic']['family_addr']?>" />
							<input class="t3_2" name="basic:family_zip_code" type="text" value="<?= $detail['basic']['family_zip_code']?>" />

							<!--第四行 个人联系地址-->
							<input class="t4_1" name="basic:contact_addr" type="text" value="<?= $detail['basic']['contact_addr']?>" />
							<input class="t4_2" name="basic:contact_zip_code" type="text" value="<?= $detail['basic']['contact_zip_code']?>" />

							<!--第五行 Email-->
							<input class="t5_1" name="basic:email" type="text" value="<?= $detail['basic']['email']?>" />
							<input class="t5_2" name="basic:telephone" type="text" value="<?= $detail['basic']['telephone']?>" />
							<input class="t5_3" name="basic:cellphone" type="text" value="<?= $detail['basic']['cellphone']?>" />

							<!--第六行 TOEFL (IBT)-->
							<div class="t6_1">
								<span>总</span><input name="exam:toefl-total_point" type="text" value="<?= $detail['exam']['toefl-total_point']?>" />
								<span>听</span><input name="exam:toefl-listening" type="text" value="<?= $detail['exam']['toefl-listening']?>" />
								<span>说</span><input name="exam:toefl-speaking" type="text" value="<?= $detail['exam']['toefl-speaking']?>" />
								<span>读</span><input name="exam:toefl-reading" type="text" value="<?= $detail['exam']['toefl-reading']?>" />
								<span>写</span><input name="exam:toefl-writing" type="text" value="<?= $detail['exam']['toefl-writing']?>" />
							</div>
							<!-- <input class="t6_1" name="" type="text" value="95，听25 说18 读28 写24 " /> -->
							<input class="t6_2" name="exam:toefl-exam_time" type="text" value="<?= $detail['exam']['toefl-exam_time']?>" />

							<!--第七行 登录ID-->
							<input class="t7_1" name="exam:toefl-login_id" type="text" value="<?= $detail['exam']['toefl-login_id']?>" />
							<input class="t7_2" name="exam:toefl-login_pswd" type="text" value="<?= $detail['exam']['toefl-login_pswd']?>" />
							<input class="t7_3" name="exam:toefl-ets_id" type="text" value="<?= $detail['exam']['toefl-ets_id']?>" />
							<input class="t7_4" name="exam:toefl-reg_serial" type="text" value="<?= $detail['exam']['toefl-reg_serial']?>" />

							<!--第八行 IELTS-->
							<div class="t8_1">
								<span>总</span><input name="exam:ielts-total_point" type="text" value="<?= $detail['exam']['ielts-total_point']?>" />
								<span>听</span><input name="exam:ielts-listening" type="text" value="<?= $detail['exam']['ielts-listening']?>" />
								<span>说</span><input name="exam:ielts-speaking" type="text" value="<?= $detail['exam']['ielts-speaking']?>" />
								<span>读</span><input name="exam:ielts-reading" type="text" value="<?= $detail['exam']['ielts-reading']?>" />
								<span>写</span><input name="exam:ielts-writing" type="text" value="<?= $detail['exam']['ielts-writing']?>" />
							</div>
							<!-- <input class="t8_1" name="" type="text" value="001" /> -->
							<input class="t8_2" name="exam:ielts-exam_serial" type="text" value="<?= $detail['exam']['ielts-exam_serial']?>" />
							<input class="t8_3" name="exam:ielts-exam_time" type="text" value="<?= $detail['exam']['ielts-exam_time']?>" />
							<input class="t8_4" name="exam:ielts-exam_place" type="text" value="<?= $detail['exam']['ielts-exam_place']?>" />

							<!--第九行 GRE-->
							<div class="t9_1">
								<span>总分：  分数</span><input name="exam:gre-total_point" type="text" value="<?= $detail['exam']['gre-total_point']?>" />%
							</div>
							<div class="t9_2">
								<span>阅读：  分数</span><input name="exam:gre-reading" type="text" value="<?= $detail['exam']['gre-reading']?>" />%
							</div>
							<div class="t9_3">
								<span>数学：  分数</span><input name="exam:gre-mathematics" type="text" value="<?= $detail['exam']['gre-mathematics']?>" />%
							</div>
							<div class="t9_4">
								<span>写作：  分数</span><input name="exam:gre-writing" type="text" value="<?= $detail['exam']['gre-writing']?>" />%
							</div>
							

							<!--第十行 注册号-->
							<input class="t10_1" name="exam:gre-reg_serial" type="text" value="<?= $detail['exam']['gre-reg_serial']?>" />
							<input class="t10_2" name="exam:gre-confirm_serial" type="text" value="<?= $detail['exam']['gre-confirm_serial']?>" />
							<input class="t10_3" name="exam:gre-exam_time" type="text" value="<?= $detail['exam']['gre-exam_time']?>" />
							<input class="t10_4" name="exam:gre-exam_place" type="text" value="<?= $detail['exam']['gre-exam_place']?>" />

							<!--第十一行 GMAT-->
							<div class="t11_1">
								<span>总分：  分数</span><input name="exam:gmat-total_point" type="text" value="<?= $detail['exam']['gmat-total_point']?>" />%
							</div>
							<div class="t11_2">
								<span>阅读：  分数</span><input name="exam:gmat-reading" type="text" value="<?= $detail['exam']['gmat-reading']?>" />%
							</div>
							<div class="t11_3">
								<span>数学：  分数</span><input name="exam:gmat-mathematics" type="text" value="<?= $detail['exam']['gmat-mathematics']?>" />%
							</div>
							<div class="t11_4">
								<span>写作：  分数</span><input name="exam:gmat-writing" type="text" value="<?= $detail['exam']['gmat-writing']?>" />%
							</div>


							<!--第十二行 登录邮箱-->
							<input class="t12_1" name="exam:gmat-login_email" type="text" value="<?= $detail['exam']['gmat-login_email']?>" />
							<input class="t12_2" name="exam:gmat-login_pswd" type="text" value="<?= $detail['exam']['gmat-login_pswd']?>" />
							<input class="t12_3" name="exam:gmat-exam_time" type="text" value="<?= $detail['exam']['gmat-exam_time']?>" />

							<!--第十三行 SAT-->
							<div class="t13_1">
								<span title="总分">总：</span><input name="exam:sat-total_point" type="text" value="<?= $detail['exam']['sat-total_point']?>" />
								<span title="数学">数：</span><input name="exam:sat-mathematics" type="text" value="<?= $detail['exam']['sat-mathematics']?>" />
								<span title="阅读">阅：</span><input name="exam:sat-reading" type="text" value="<?= $detail['exam']['sat-reading']?>" />
								<span title="写作">写：</span><input name="exam:sat-writing" type="text" value="<?= $detail['exam']['sat-writing']?>" />
							</div>
							<input class="t13_2" name="exam:sat-exam_time" type="text" value="<?= $detail['exam']['sat-exam_time']?>" />
							<input class="t13_3" name="exam:sat-exam_place" type="text" value="<?= $detail['exam']['sat-exam_place']?>" />

							<!--第十四行 父亲姓名-->
							<input class="t14_1" name="family:dad-real_name" type="text" value="<?= $detail['family']['dad']['real_name']?>" />
							<input class="t14_2" name="family:mom-real_name" type="text" value="<?= $detail['family']['mom']['real_name']?>" />

							<!--第十五行 手机-->
							<input class="t15_1" name="family:dad-cellphone" type="text" value="<?= $detail['family']['dad']['cellphone']?>" />
							<input class="t15_2" name="family:mom-cellphone" type="text" value="<?= $detail['family']['mom']['cellphone']?>" />

							<!--第十六行 工作单位全称-->
							<input class="t16_1" name="family:dad-company" type="text" value="<?= $detail['family']['dad']['company']?>" />
							<input class="t16_2" name="family:mom-company" type="text" value="<?= $detail['family']['mom']['company']?>" />

							<!--第十七行 职位/职称-->
							<input class="t17_1" name="family:dad-position" type="text" value="<?= $detail['family']['dad']['position']?>" />
							<input class="t17_2" name="family:mom-position" type="text" value="<?= $detail['family']['mom']['position']?>" />

							<!--第十八行 初中学校-->
							<input class="t18_1" name="edu:middle-school" type="text" value="<?= $detail['edu']['middle-school']?>" />
							<input class="t18_2" name="edu:middle-property" type="text" value="<?= $detail['edu']['middle-property']?>" />

							<!--第十九行 学校地址-->
							<input class="t19_1" name="edu:middle-address" type="text" value="<?= $detail['edu']['middle-address']?>" />
							<input class="t19_2" name="edu:middle-zip_code" type="text" value="<?= $detail['edu']['middle-zip_code']?>" />

							<!--第二十行 入读时间-->
							<input class="t20_1" name="edu:middle-entrance_time" type="text" value="<?= $detail['edu']['middle-entrance_time']?>" />
							<input class="t20_2" name="edu:middle-departure_time" type="text" value="<?= $detail['edu']['middle-departure_time']?>" />
							<input class="t20_3" name="edu:middle-languages" type="text" value="<?= $detail['edu']['middle-languages']?>" />

							<!--第二十一行 高中学校-->
							<input class="t21_1" name="edu:high-school" type="text" value="<?= $detail['edu']['high-school']?>" />
							<input class="t21_2" name="edu:high-property" type="text" value="<?= $detail['edu']['high-property']?>" />

							<!--第二十二行 学校地址-->
							<input class="t22_1" name="edu:high-address" type="text" value="<?= $detail['edu']['high-address']?>" />
							<input class="t22_2" name="edu:high-zip_code" type="text" value="<?= $detail['edu']['high-zip_code']?>" />

							<!--第二十三行 入读时间-->
							<input class="t23_1" name="edu:high-entrance_time" type="text" value="<?= $detail['edu']['high-entrance_time']?>" />
							<input class="t23_2" name="edu:high-departure_time" type="text" value="<?= $detail['edu']['high-departure_time']?>" />
							<input class="t23_3" name="edu:high-languages" type="text" value="<?= $detail['edu']['high-languages']?>" />


							<!--第二十四行 大学学校1-->
							<input class="t24_1" name="edu:college-school[]" type="text" value="<?= $detail['edu']['college-school_1']?>" />
							<input class="t24_2" name="edu:college-cellphone[]" type="text" value="<?= $detail['edu']['college-cellphone_1']?>" />

							<!--第二十五行 学校地址-->
							<input class="t25_1" name="edu:college-address[]" type="text" value="<?= $detail['edu']['college-address_1']?>" />
							<input class="t25_2" name="edu:college-zip_code[]" type="text" value="<?= $detail['edu']['college-zip_code_1']?>" />

							<!--第二十六行 入读时间-->
							<input class="t26_1" name="edu:college-entrance_time[]" type="text" value="<?= $detail['edu']['college-entrance_time_1']?>" />
							<input class="t26_2" name="edu:college-departure_time[]" type="text" value="<?= $detail['edu']['college-departure_time_1']?>" />
							<input class="t26_3" name="edu:college-languages[]" type="text" value="<?= $detail['edu']['college-languages_1']?>" />

							<!--第二十七行 攻读学位-->
							<input class="t27_1" name="edu:college-1st_major[]" type="text" value="<?= $detail['edu']['college-1st_major_1']?>" />
							<div class="t27_2">
								<span>中：</span><input name="edu:college-1st_major_ch[]" type="text" value="<?= $detail['edu']['college-1st_major_ch_1']?>" />
								<span>英：</span><input name="edu:college-1st_major_en[]" type="text" value="<?= $detail['edu']['college-1st_major_en_1']?>" />
							</div>

							<!--第二十八行 第二学位-->
							<input class="t28_1" name="edu:college-2nd_major[]" type="text" value="<?= $detail['edu']['college-2nd_major_1']?>" />
							<div class="t28_2">
								<span>中：</span><input name="edu:college-2nd_major_ch[]" type="text" value="<?= $detail['edu']['college-2nd_major_ch_1']?>" />
								<span>英：</span><input name="edu:college-2nd_major_en[]" type="text" value="<?= $detail['edu']['college-2nd_major_en_1']?>" />
							</div>

							<!--第二十九行 平均分-->
							<input class="t29_1" name="edu:college-average_point[]" type="text" value="<?= $detail['edu']['college-average_point_1']?>" />
							<input class="t29_2" name="edu:college-sub_average_point[]" type="text" value="<?= $detail['edu']['college-sub_average_point_1']?>" />

							<!--第三十行 大学学校2-->
							<input class="t30_1" name="edu:college-school[]" type="text" value="<?= $detail['edu']['college-school_2']?>" />
							<input class="t30_2" name="edu:college-cellphone[]" type="text" value="<?= $detail['edu']['college-cellphone_2']?>" />

							<!--第三十一行 学校地址-->
							<input class="t31_1" name="edu:college-address[]" type="text" value="<?= $detail['edu']['college-address_2']?>" />
							<input class="t31_2" name="edu:college-zip_code[]" type="text" value="<?= $detail['edu']['college-zip_code_2']?>" />

							<!--第三十二行 入读时间-->
							<input class="t32_1" name="edu:college-entrance_time[]" type="text" value="<?= $detail['edu']['college-entrance_time_2']?>" />
							<input class="t32_2" name="edu:college-departure_time[]" type="text" value="<?= $detail['edu']['college-departure_time_2']?>" />
							<input class="t32_3" name="edu:college-languages[]" type="text" value="<?= $detail['edu']['college-languages_2']?>" />

							<!--第三十三行 攻读学位-->
							<input class="t33_1" name="edu:college-1st_major[]" type="text" value="<?= $detail['edu']['college-1st_major_2']?>" />
							<div class="t33_2">
								<span>中：</span><input name="edu:college-1st_major_ch[]" type="text" value="<?= $detail['edu']['college-1st_major_ch_2']?>" />
								<span>英：</span><input name="edu:college-1st_major_en[]" type="text" value="<?= $detail['edu']['college-1st_major_en_2']?>" />
							</div>

							<!--第三十四行 第二学位-->
							<input class="t34_1" name="edu:college-2nd_major[]" type="text" value="<?= $detail['edu']['college-2nd_major_2']?>" />
							<div class="t34_2">
								<span>中：</span><input name="edu:college-2nd_major_ch[]" type="text" value="<?= $detail['edu']['college-2nd_major_ch_2']?>" />
								<span>英：</span><input name="edu:college-2nd_major_en[]" type="text" value="<?= $detail['edu']['college-2nd_major_en_2']?>" />
							</div>

							<!--第三十五行 平均分-->
							<input class="t35_1" name="edu:college-average_point[]" type="text" value="<?= $detail['edu']['college-average_point_2']?>" />
							<input class="t35_2" name="edu:college-sub_average_point[]" type="text" value="<?= $detail['edu']['college-sub_average_point_2']?>" />

							<!--第三十六行 研究生学校-->
							<input class="t36_1" name="edu:institute-school" type="text" value="<?= $detail['edu']['institute-school']?>" />

							<!--第三十七行 学校地址-->
							<input class="t37_1" name="edu:institute-address" type="text" value="<?= $detail['edu']['institute-address']?>" />
							<input class="t37_2" name="edu:institute-zip_code" type="text" value="<?= $detail['edu']['institute-zip_code']?>" />

							<!--第三十八行 入读时间-->
							<input class="t38_1" name="edu:institute-entrance_time" type="text" value="<?= $detail['edu']['institute-entrance_time']?>" />
							<input class="t38_2" name="edu:institute-departure_time" type="text" value="<?= $detail['edu']['institute-departure_time']?>" />
							<input class="t38_3" name="edu:institute-languages" type="text" value="<?= $detail['edu']['institute-languages']?>" />

							<!--第三十九行 攻读学位-->
							<input class="t39_1" name="edu:institute-1st_major" type="text" value="<?= $detail['edu']['institute-1st_major']?>" />
							<div class="t39_2">
								<span>中：</span><input name="edu:institute-1st_major_ch" type="text" value="<?= $detail['edu']['institute-1st_major_ch']?>" />
								<span>英：</span><input name="edu:institute-1st_major_en" type="text" value="<?= $detail['edu']['institute-1st_major_en']?>" />
							</div>

							<!--第四十行 第二学位-->
							<input class="t40_1" name="edu:institute-2nd_major" type="text" value="<?= $detail['edu']['institute-2nd_major']?>" />
							<div class="t40_2">
								<span>中：</span><input name="edu:institute-2nd_major_ch" type="text" value="<?= $detail['edu']['institute-2nd_major_ch']?>" />
								<span>英：</span><input name="edu:institute-2nd_major_en" type="text" value="<?= $detail['edu']['institute-2nd_major_en']?>" />
							</div>
							
							<!--第四十一行 平均分-->
							<input class="t41_1" name="edu:institute-average_point" type="text" value="<?= $detail['edu']['institute-average_point']?>" />
							
							<!--第四十二行 学习排名-->
							<input class="t42_1" name="edu:institute-study_ranking" type="text" value="<?= $detail['edu']['institute-study_ranking']?>" />

							<!--第四十三行 目前在读课程-->
							<input class="t43_1" name="edu:institute-studing_courses" type="text" value="<?= $detail['edu']['institute-studing_courses']?>" />

							<!--第四十四行 已完成学分-->
							<input class="t44_1" name="edu:institute-obtained_credits" type="text" value="<?= $detail['edu']['institute-obtained_credits']?>" />

							<!--第四十五行 待修课程-->
							<input class="t45_1" name="edu:institute-remaining_courses" type="text" value="<?= $detail['edu']['institute-remaining_courses']?>" />
							<input class="t45_2" name="edu:institute-remaining_time" type="text" value="<?= $detail['edu']['institute-remaining_time']?>" />

							<!--第四十六行 申请学位-->
							<input class="t46_1" name="application:degree" type="text" value="<?= $detail['application']['degree']?>" />
							<input class="t46_2" name="application:entrance_time" type="text" value="<?= $detail['application']['entrance_time']?>" />
							<input class="t46_3" name="application:major" type="text" value="<?= $detail['application']['major']?>" />

							<!--第四十七行 申请国家和地区-->
							<input class="t47_1" name="application:country_region" type="text" value="<?= $detail['application']['country_region']?>" />
							<input class="t47_2" name="application:expenses_expected" type="text" value="<?= $detail['application']['expenses_expected']?>" />
							<input class="t47_3" name="application:school_type" type="text" value="<?= $detail['application']['school_type']?>" />

							<!--第四十八行 其他选校要求-->
							<input class="t48_1" name="application:school_requirement" type="text" value="<?= $detail['application']['school_requirement']?>" />

							<!--第四十九行 意向学校-->
							<input class="t49_1" name="application:school_expected" type="text" value="<?= $detail['application']['school_expected']?>" />

							<!--第五十行 姓名-->
							<input class="t50_1" name="referee:real_name" type="text" value="<?= $detail['referee']['real_name']?>" />
							<input class="t50_2" name="referee:sex" type="text" value="<?= $detail['referee']['sex']?>" />

							<!--第五十一行 单位-->
							<input class="t51_1" name="referee:company" type="text" value="<?= $detail['referee']['company']?>" />
							<input class="t51_2" name="referee:email" type="text" value="<?= $detail['referee']['email']?>" />

							<!--第五十二行 电话-->
							<input class="t52_1" name="referee:telephone" type="text" value="<?= $detail['referee']['telephone']?>" />
							<input class="t52_2" name="referee:qq_weixin" type="text" value="<?= $detail['referee']['qq_weixin']?>" />

							<!--第五十三行 通信地址-->
							<input class="t53_1" name="referee:addr" type="text" value="<?= $detail['referee']['addr']?>" />
							<input class="t53_2" name="referee:zip_code" type="text" value="<?= $detail['referee']['zip_code']?>" />
							
							<!--<div class="btnDiv">
								<div class="sure" onclick="alert(213);">修改</div>
							</div>-->
			        	</form>       
			        </div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</div>

<?php include APPPATH .'views/manage/footer.php'?>