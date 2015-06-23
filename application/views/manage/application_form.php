<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>赢凯教育</title>
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/index.css">
	<link rel="stylesheet" type="text/css" href="/css/form.css" />
	<script src="/js/jquery-1.8.2.min.js"></script>
</head>
<body>
	
	<div class="formDiv">
		
		<div class="title">网上课程申请表</div>
		<div class="instro">
			填表说明：此表中的每项信息对学员的高效学习非常重要，请认真并尽量详细地填写每一项可以填写的信息。<br>
            在填写过程中请仔细阅读每一部分红色字体的说明。
        </div>

        <div class="form">
        	<form action="" id="form">
        		
        		<!--第一行 姓名-->
				<input class="t1_1" name="basic:real_name" type="text" value="" placeholder="请输入学生姓名"/>
				<input class="t1_2" name="basic:used_name" type="text" value="" />
				<input class="t1_3" name="basic:birthday" type="text" value="" />
				<input class="t1_4" name="basic:sex" type="text" value="" />
				
				<!--第二行 Username-->
				<input class="t2_1" name="student:username" type="text" value="<?= $username?>" placeholder="请输入付费帐号"/>
				<input class="t2_2" name="student:password" type="password" id="password" value="<?= $password?>" placeholder="请输入帐号密码"/>
				<input class="t2_3" name="basic:born_city" type="text" value="" />
				<input class="t2_4" name="basic:marriage" type="text" value="" />

				<!--第三行 家庭常住地址-->
				<input class="t3_1" name="basic:family_addr" type="text" value="" />
				<input class="t3_2" name="basic:family_zip_code" type="text" value="" />

				<!--第四行 个人联系地址-->
				<input class="t4_1" name="basic:contact_addr" type="text" value="" />
				<input class="t4_2" name="basic:contact_zip_code" type="text" value="" />

				<!--第五行 Email-->
				<input class="t5_1" name="basic:email" type="text" value="" />
				<input class="t5_2" name="basic:telephone" type="text" value="" />
				<input class="t5_3" name="basic:cellphone" type="text" value="" placeholder="请输入手机号码" />

				<!--第六行 TOEFL (IBT)-->
				<div class="t6_1">
					<span>总</span><input name="exam:toefl-total_point" type="text" value="" />
					<span>听</span><input name="exam:toefl-listening" type="text" value="" />
					<span>说</span><input name="exam:toefl-speaking" type="text" value="" />
					<span>读</span><input name="exam:toefl-reading" type="text" value="" />
					<span>写</span><input name="exam:toefl-writing" type="text" value="" />
				</div>
				<!-- <input class="t6_1" name="" type="text" value="95，听25 说18 读28 写24 " /> -->
				<input class="t6_2" name="exam:toefl-exam_time" type="text" value="" />

				<!--第七行 登录ID-->
				<input class="t7_1" name="exam:toefl-login_id" type="text" value="" />
				<input class="t7_2" name="exam:toefl-login_pswd" type="text" value="" />
				<input class="t7_3" name="exam:toefl-ets_id" type="text" value="" />
				<input class="t7_4" name="exam:toefl-reg_serial" type="text" value="" />

				<!--第八行 IELTS-->
				<div class="t8_1">
					<span>总</span><input name="exam:ielts-total_point" type="text" value="" />
					<span>听</span><input name="exam:ielts-listening" type="text" value="" />
					<span>说</span><input name="exam:ielts-speaking" type="text" value="" />
					<span>读</span><input name="exam:ielts-reading" type="text" value="" />
					<span>写</span><input name="exam:ielts-writing" type="text" value="" />
				</div>
				<!-- <input class="t8_1" name="" type="text" value="001" /> -->
				<input class="t8_2" name="exam:ielts-exam_serial" type="text" value="" />
				<input class="t8_3" name="exam:ielts-exam_time" type="text" value="" />
				<input class="t8_4" name="exam:ielts-exam_place" type="text" value="" />

				<!--第九行 GRE-->
				<div class="t9_1">
					<span>总分：  分数</span><input name="exam:gre-total_point" type="text" value="" />%
				</div>
				<div class="t9_2">
					<span>阅读：  分数</span><input name="exam:gre-reading" type="text" value="" />%
				</div>
				<div class="t9_3">
					<span>数学：  分数</span><input name="exam:gre-mathematics" type="text" value="" />%
				</div>
				<div class="t9_4">
					<span>写作：  分数</span><input name="exam:gre-writing" type="text" value="" />%
				</div>
				

				<!--第十行 注册号-->
				<input class="t10_1" name="exam:gre-reg_serial" type="text" value="" />
				<input class="t10_2" name="exam:gre-confirm_serial" type="text" value="" />
				<input class="t10_3" name="exam:gre-exam_time" type="text" value="" />
				<input class="t10_4" name="exam:gre-exam_place" type="text" value="" />

				<!--第十一行 GMAT-->
				<div class="t11_1">
					<span>总分：  分数</span><input name="exam:gmat-total_point" type="text" value="" />%
				</div>
				<div class="t11_2">
					<span>阅读：  分数</span><input name="exam:gmat-reading" type="text" value="" />%
				</div>
				<div class="t11_3">
					<span>数学：  分数</span><input name="exam:gmat-mathematics" type="text" value="" />%
				</div>
				<div class="t11_4">
					<span>写作：  分数</span><input name="exam:gmat-writing" type="text" value="" />%
				</div>


				<!--第十二行 登录邮箱-->
				<input class="t12_1" name="exam:gmat-login_email" type="text" value="" />
				<input class="t12_2" name="exam:gmat-login_pswd" type="text" value="" />
				<input class="t12_3" name="exam:gmat-exam_time" type="text" value="" />

				<!--第十三行 SAT-->
				<div class="t13_1">
					<span title="总分">总：</span><input name="exam:sat-total_point" type="text" value="" />
					<span title="数学">数：</span><input name="exam:sat-mathematics" type="text" value="" />
					<span title="阅读">阅：</span><input name="exam:sat-reading" type="text" value="" />
					<span title="写作">写：</span><input name="exam:sat-writing" type="text" value="" />
				</div>
				<input class="t13_2" name="exam:sat-exam_time" type="text" value="" />
				<input class="t13_3" name="exam:sat-exam_place" type="text" value="" />

				<!--第十四行 父亲姓名-->
				<input class="t14_1" name="family:dad-real_name" type="text" value="" />
				<input class="t14_2" name="family:mom-real_name" type="text" value="" />

				<!--第十五行 手机-->
				<input class="t15_1" name="family:dad-cellphone" type="text" value="" />
				<input class="t15_2" name="family:mom-cellphone" type="text" value="" />

				<!--第十六行 工作单位全称-->
				<input class="t16_1" name="family:dad-company" type="text" value="" />
				<input class="t16_2" name="family:mom-company" type="text" value="" />

				<!--第十七行 职位/职称-->
				<input class="t17_1" name="family:dad-position" type="text" value="" />
				<input class="t17_2" name="family:mom-position" type="text" value="" />

				<!--第十八行 初中学校-->
				<input class="t18_1" name="edu:middle-school" type="text" value="" />
				<input class="t18_2" name="edu:middle-property" type="text" value="" />

				<!--第十九行 学校地址-->
				<input class="t19_1" name="edu:middle-address" type="text" value="" />
				<input class="t19_2" name="edu:middle-zip_code" type="text" value="" />

				<!--第二十行 入读时间-->
				<input class="t20_1" name="edu:middle-entrance_time" type="text" value="" />
				<input class="t20_2" name="edu:middle-departure_time" type="text" value="" />
				<input class="t20_3" name="edu:middle-languages" type="text" value="" />

				<!--第二十一行 高中学校-->
				<input class="t21_1" name="edu:high-school" type="text" value="" />
				<input class="t21_2" name="edu:high-property" type="text" value="" />

				<!--第二十二行 学校地址-->
				<input class="t22_1" name="edu:high-address" type="text" value="" />
				<input class="t22_2" name="edu:high-zip_code" type="text" value="" />

				<!--第二十三行 入读时间-->
				<input class="t23_1" name="edu:high-entrance_time" type="text" value="" />
				<input class="t23_2" name="edu:high-departure_time" type="text" value="" />
				<input class="t23_3" name="edu:high-languages" type="text" value="" />


				<!--第二十四行 大学学校1-->
				<input class="t24_1" name="edu:college-school[]" type="text" value="" />
				<input class="t24_2" name="edu:college-cellphone[]" type="text" value="" />

				<!--第二十五行 学校地址-->
				<input class="t25_1" name="edu:college-address[]" type="text" value="" />
				<input class="t25_2" name="edu:college-zip_code[]" type="text" value="" />

				<!--第二十六行 入读时间-->
				<input class="t26_1" name="edu:college-entrance_time[]" type="text" value="" />
				<input class="t26_2" name="edu:college-departure_time[]" type="text" value="" />
				<input class="t26_3" name="edu:college-languages[]" type="text" value="" />

				<!--第二十七行 攻读学位-->
				<input class="t27_1" name="edu:college-1st_major[]" type="text" value="" />
				<div class="t27_2">
					<span>中：</span><input name="edu:college-1st_major_ch[]" type="text" value="" />
					<span>英：</span><input name="edu:college-1st_major_en[]" type="text" value="" />
				</div>

				<!--第二十八行 第二学位-->
				<input class="t28_1" name="edu:college-2nd_major[]" type="text" value="" />
				<div class="t28_2">
					<span>中：</span><input name="edu:college-2nd_major_ch[]" type="text" value="" />
					<span>英：</span><input name="edu:college-2nd_major_en[]" type="text" value="" />
				</div>

				<!--第二十九行 平均分-->
				<input class="t29_1" name="edu:college-average_point[]" type="text" value="" />
				<input class="t29_2" name="edu:college-sub_average_point[]" type="text" value="" />

				<!--第三十行 大学学校2-->
				<input class="t30_1" name="edu:college-school[]" type="text" value="" />
				<input class="t30_2" name="edu:college-cellphone[]" type="text" value="" />

				<!--第三十一行 学校地址-->
				<input class="t31_1" name="edu:college-address[]" type="text" value="" />
				<input class="t31_2" name="edu:college-zip_code[]" type="text" value="" />

				<!--第三十二行 入读时间-->
				<input class="t32_1" name="edu:college-entrance_time[]" type="text" value="" />
				<input class="t32_2" name="edu:college-departure_time[]" type="text" value="" />
				<input class="t32_3" name="edu:college-languages[]" type="text" value="" />

				<!--第三十三行 攻读学位-->
				<input class="t33_1" name="edu:college-1st_major[]" type="text" value="" />
				<div class="t33_2">
					<span>中：</span><input name="edu:college-1st_major_ch[]" type="text" value="" />
					<span>英：</span><input name="edu:college-1st_major_en[]" type="text" value="" />
				</div>

				<!--第三十四行 第二学位-->
				<input class="t34_1" name="edu:college-2nd_major[]" type="text" value="" />
				<div class="t34_2">
					<span>中：</span><input name="edu:college-2nd_major_ch[]" type="text" value="" />
					<span>英：</span><input name="edu:college-2nd_major_en[]" type="text" value="" />
				</div>

				<!--第三十五行 平均分-->
				<input class="t35_1" name="edu:college-average_point[]" type="text" value="" />
				<input class="t35_2" name="edu:college-sub_average_point[]" type="text" value="" />

				<!--第三十六行 研究生学校-->
				<input class="t36_1" name="edu:institute-school" type="text" value="" />

				<!--第三十七行 学校地址-->
				<input class="t37_1" name="edu:institute-address" type="text" value="" />
				<input class="t37_2" name="edu:institute-zip_code" type="text" value="" />

				<!--第三十八行 入读时间-->
				<input class="t38_1" name="edu:institute-entrance_time" type="text" value="" />
				<input class="t38_2" name="edu:institute-departure_time" type="text" value="" />
				<input class="t38_3" name="edu:institute-languages" type="text" value="" />

				<!--第三十九行 攻读学位-->
				<input class="t39_1" name="edu:institute-1st_major" type="text" value="" />
				<div class="t39_2">
					<span>中：</span><input name="edu:institute-1st_major_ch" type="text" value="" />
					<span>英：</span><input name="edu:institute-1st_major_en" type="text" value="" />
				</div>

				<!--第四十行 第二学位-->
				<input class="t40_1" name="edu:institute-2nd_major" type="text" value="" />
				<div class="t40_2">
					<span>中：</span><input name="edu:institute-2nd_major_ch" type="text" value="" />
					<span>英：</span><input name="edu:institute-2nd_major_en" type="text" value="" />
				</div>
				
				<!--第四十一行 平均分-->
				<input class="t41_1" name="edu:institute-average_point" type="text" value="" />
				
				<!--第四十二行 学习排名-->
				<input class="t42_1" name="edu:institute-study_ranking" type="text" value="" />

				<!--第四十三行 目前在读课程-->
				<input class="t43_1" name="edu:institute-studing_courses" type="text" value="" />

				<!--第四十四行 已完成学分-->
				<input class="t44_1" name="edu:institute-obtained_credits" type="text" value="" />

				<!--第四十五行 待修课程-->
				<input class="t45_1" name="edu:institute-remaining_courses" type="text" value="" />
				<input class="t45_2" name="edu:institute-remaining_time" type="text" value="" />

				<!--第四十六行 申请学位-->
				<input class="t46_1" name="application:degree" type="text" value="" />
				<input class="t46_2" name="application:entrance_time" type="text" value="" />
				<input class="t46_3" name="application:major" type="text" value="" />

				<!--第四十七行 申请国家和地区-->
				<input class="t47_1" name="application:country_region" type="text" value="" />
				<input class="t47_2" name="application:expenses_expected" type="text" value="" />
				<input class="t47_3" name="application:school_type" type="text" value="" />

				<!--第四十八行 其他选校要求-->
				<input class="t48_1" name="application:school_requirement" type="text" value="" />

				<!--第四十九行 意向学校-->
				<input class="t49_1" name="application:school_expected" type="text" value="" />

				<!--第五十行 姓名-->
				<input class="t50_1" name="referee:real_name" type="text" value="" />
				<input class="t50_2" name="referee:sex" type="text" value="" />

				<!--第五十一行 单位-->
				<input class="t51_1" name="referee:company" type="text" value="" />
				<input class="t51_2" name="referee:email" type="text" value="" />

				<!--第五十二行 电话-->
				<input class="t52_1" name="referee:telephone" type="text" value="" />
				<input class="t52_2" name="referee:qq_weixin" type="text" value="" />

				<!--第五十三行 通信地址-->
				<input class="t53_1" name="referee:addr" type="text" value="" />
				<input class="t53_2" name="referee:zip_code" type="text" value="" />
				
				<div class="btnDiv">
					<div class="activate" id="info-submit">提交</div>
					<div class="refresh" id="info-clean">清空</div>
				</div>
				
        	</form>       
        </div>

	</div>
	
	<script src="/js/md5-min.js"></script>
	<script src="/js/cr_page.js"></script>
	<script src="/js/common.js"></script>	
	<script src="/js/index.js"></script>
	
	<script>
		var _form = $("#form");
		
		//表单提交
		$('#info-clean').click(function(){
			document.getElementById('form').reset();
		});
		
		//表单提交
		$('#info-submit').click(function(){

			var _realName = $('input[name="basic:real_name"]').val();  //姓名
			var _stuName = $('input[name="student:username"]').val();   //userName
			var _stuPwd = $('input[name="student:password"]').val(); //密码			
			var _cellPhone = $('input[name="basic:cellphone"]').val();  //手机

			// console.log(_realName+'+'+_stuName+'+'+_stuPwd+'+'+_cellPhone);

			if(_realName==''||_stuName==''||_stuPwd==''||_cellPhone==''){
				alert('带*的为必填项！');
				return;
			}

			var _passWord = $('#password'),
				_passWordVal = _passWord.val(),
				_md5PassWord = hex_md5(_passWordVal);

			_passWord.val(_md5PassWord);
			var _dataStr = _form.serialize();
			console.log(_dataStr);
			$.ajax({
				url: '<?= base_url('manage/application/activateAccount')?>',
				type: 'POST',
				dataType: 'JSON',
				data: _dataStr,
				success:function(dataJson){
					if(dataJson.code == 0){
						alert('注册成功，帐号已激活');
						window.location.reload();
					}else if(dataJson.code == 2){
						alert('帐号密码不正确！');
					}else if(dataJson.code == 3){
						alert('该帐号不存在！');
					}else if(dataJson.code == 6){
						alert('该帐号已经注册！');
					} else {
						alert('注册失败,请检查');
					}
				},
				error:function(){
					alert('网络异常');
				}
			});
			
		});
		
		
		setComment('indexComment',0,'gre','public');
		$('#indexCommentPage').creat_page({
		    countPage:totalCommentPageMark,
		    nowPage:1,
		    showPage:5,
		    pageClick:function(_nowPage){
		    	var _num = _nowPage - 1;
		        setComment('indexComment',_num,'gre','public');
		    }
		})
	</script>
</body>
</html>