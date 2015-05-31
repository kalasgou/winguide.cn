var _url = window.location.href;
var isGmat = false;
var isToefl = false;

var markTopicID = null;
var totalArcticlePageMark = null;
var totalCommentPageMark = null;
var userData = null;


if(_url.indexOf('gmat') > -1){
	isGmat = true;
} else if(_url.indexOf('toefl') > -1) {
	isToefl = true;
}
setUserInfo();

function setUserInfo(){
	$.ajax({
		url:'http://120.25.228.56/user/info',
		async:false,
		dataType:'json',
		success:function(dataJson){
			if(dataJson.code === 0){
				userData = dataJson.user_info;

				$('.login_area').empty();
				var str = '<div class="userName">'+dataJson.user_info.basic.nickname+'</div><div class="loginOut">退出</div>';
				$('.login_area').append(str);					
			}
		}
	});
};

$(document).delegate('.loginOut', 'click', function(event) {
	$.ajax({
		url:'http://120.25.228.56/user/logout',
		dataType:'json',
		success:function(dataJson){
			if(dataJson.code === 0){
				window.location.reload();
			}
		}
	})
});


$('.gmatNav ul li').on('mouseenter',function(){

	$(this).siblings().removeClass('on');
	$(this).addClass('on');

})

// $('.gmatNav ul li').on('click',function(){

// 	var _index = $(this).index();

// 	if(isGmat){
// 		window.location.href = './gmat_sun.html?tap='+_index;
// 	} else if(isToefl){
// 		window.location.href = './toefl_sun.html?tap='+_index;
// 	}

// })





//console.log($('.gCon'));

// 详情tap
// var nowIndex = null;

// if(_url.indexOf('_sun') > -1){

// 	var indexTap = parseInt(getQueryString('tap'));
// 	nowIndex = indexTap;

// 	$('.gSunNav ul li').eq(indexTap).siblings().removeClass('on');
// 	$('.gSunNav ul li').eq(indexTap).addClass('on')


// 	$('.gCon').hide();
// 	$('.gCon').eq(indexTap).show();

// }



/*定义当前页面的index值*/

var tabIndex = ['article','system','video','info','dynamic','gmat_about'];
var markTabIndex = null;
var markI = tabIndex.length;

while(markI--){

	if(_url.indexOf(tabIndex[markI]) > -1){
		
		markTabIndex = markI;
	}
}

console.log(markTabIndex)



$('.gSunNav ul li').on('mouseenter',function(){

	$(this).siblings().removeClass('on');
	$(this).addClass('on');
	// var _index = $(this).index();

	// if(nowIndex == _index) return;

	// nowIndex = _index;

	// $('.gCon').fadeOut();
	// $('.gCon').eq(_index).delay(200).fadeIn();
});


$('.gSunNav ul').on('mouseleave',function(){

	$('.gSunNav ul li').removeClass('on');
	$('.gSunNav ul li').eq(markTabIndex).addClass('on');
	// var _index = $(this).index();

	// if(nowIndex == _index) return;

	// nowIndex = _index;

	// $('.gCon').fadeOut();
	// $('.gCon').eq(_index).delay(200).fadeIn();
});












function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return decodeURIComponent(r[2]); return null;
}



























// 设置原创

function writeArticle(obj,title,time,articleId){
	var str = '';
	str +=					'<li data-articleId = "'+articleId+'">';
	str +=						'<em>></em>';
	str +=						'<p>'+title+'</p>';
	str +=						'<span>'+time+'</span>';
	str +=					'</li>';

	obj.append(str)

}

function setArticle(name,page,course,module){
	
	var obj = $('#'+name+'');
	obj.empty();
	var dataOpt = {
		item : 10,
		page : page,
		course : course,
		module : module,
	};

	$.ajax({
		url:'http://120.25.228.56/article/lists',
		data:dataOpt,
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			totalArcticlePageMark = dataJson.total_page;

			if(dataJson.code >= 10){
				alert('只有学员才能进入改系统或者测试，请在首页登录后，再操作');
				window.location.href = '../index.html'
				return;
			}

			if(dataJson.code >= 7){
				$('.alert_bg,.loginAlert').show();
				showLoginTag(0);
				return;
			}


			if(dataJson.code === 0 && dataJson.articles.length > 0){




				var i = 0;
				var data = dataJson.articles;
				var limit = data.length;

				for (i; i < limit; i++) {
					
					writeArticle(obj,data[i].title,data[i].create_time_formatted,data[i].uuid);

				};

			} else {
				var str = '';
				str += '<div style="width:100%;height:60px;position:absolute;top:50%;margin-top:-30px;color:#90c31f;font-size:46px;line-height:60px;text-align:center;">';
				str +=	'敬请期待';
				str += '</div>';
				$('.gCon').empty().append(str);
			}
		}
	});


}


// 评论区

function writeComment(obj,nickname,time,reply){
	var str = '';
	str +=						'<li>';
	str +=							'<div class="tk_user_info">';
	str +=								'<span>';
	str +=									'<img src="../img/index/user_mimo.png" height="26" width="25" alt="">';
	str +=								'</span>';
	str +=								'<span>';
	str +=									nickname;
	str +=								'</span>';
	str +=								'<span>';
	str +=									time
	str +=								'</span>';
	str +=							'</div>';
	if(obj.attr('id') == 'indexComment'){
		str +=							'<div class="say_something_index">';
	} else {
		str +=							'<div class="say_something">';
	}
	
	str +=								reply;
	str +=							'</div>';
	str +=						'</li>';

	obj.append(str)

}

function setComment(name,page,course,module){


	var obj = $('#'+name+'');

	obj.empty();

	var dataOpt = {
		item : 5,
		page : page,
		course : course,
		module : module,
	}

	$.ajax({
		url:'http://120.25.228.56/forum/getThreads',
		data:dataOpt,
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			markTopicID = dataJson.topic.topic_id;
			totalCommentPageMark = dataJson.topic.total_page;

			$('.all_num').find('span').text(dataJson.topic.total_replies);


			if(dataJson.code === 0 && dataJson.topic.replies.length > 0){

				var i = 0;
				var data = dataJson.topic.replies;
				var limit = data.length;

				for (i; i < limit; i++) {
					
					writeComment(obj,data[i].nickname,data[i].create_time_formatted,data[i].reply);

				};

			} else {
				$('.spit_page').eq(1).remove();
				$('.show_talk').children('ul').empty();
				$('.show_talk').children('ul').append('<li style="text-align: center;font-size:24px;">暂无留言</li>');
			}
		}
	});
}


// 提交评论


function pushComment(reply){

	if(markTopicID == null) return;

	var opt = {
		topic_id : markTopicID,
		reply : reply
	}

	$.ajax({
		url : 'http://120.25.228.56/forum/postReply',
		data : opt,
		dataType : 'json',
		type : 'post',
		success : function(dataJson){
			if(dataJson.code == 0){
				alert('评论成功');
				var str = '<li><div class="tk_user_info"><span><img src="../img/index/user_mimo.png" height="26" width="25" alt=""></span><span>'+dataJson.nickname+'</span><span>'+dataJson.post_time+'</span></div><div class="say_something">'+opt.reply+'</div></li>'
				if(window.location.href.indexOf('system')){
					$('.show_talk').find('ul').eq(1).find('li').eq(0).before(str);
				} else {
					$('.show_talk').find('li').eq(0).before(str);
				}
				
			} else {
				alert('评论失败');
			}
		}
	});

}



// 设置sum的动态


function writeSumDynamic(obj,articleId,title,time){
	var str = '';
	str += 				'<li data-articleId="'+articleId+'">';
	str +=					'<a href="javascript:">';
	str +=						'<span class="txt">';
	str +=							title;
	str +=						'</span>';
	str +=						'<span class="time">';
	str +=							time;
	str +=						'</span>';
	str +=					'</a>';
	str +=				'</li>';

	obj.append(str);
} 

function setSumDynamic(name,course){
	
	var obj = $('#'+name+'');
	obj.empty();
	var dataOpt = {
		course : course
	};


	$.ajax({
		url:'http://120.25.228.56/article/news',
		data:dataOpt,
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			if(dataJson.code === 0 && dataJson.articles.length > 0){




				var i = 0;
				var data = dataJson.articles;
				var limit = data.length;

				for (i; i < limit; i++) {
					
					writeSumDynamic(obj,data[i].uuid,data[i].title,data[i].create_time_formatted);

				};

			}
		}
	});


}



$('.input_submit_btn').click(function(){

	var _reply = $('#replyArea').val();
	if(_reply == ''){
		alert('请输入留言');
		return;
	}

	pushComment(_reply);

});

//显示登录框
$('.login_not').click(function(){
	$('.alert_bg,.loginAlert').show();
});


//关闭弹出层al_closed
$('.al_closed').click(function(){
	$('.alert_bg,.alert').hide();
});

//显示注册框
$('.show_reg').click(function(){
	$('.loginAlert').hide();
	$('.regAlert').show();
});

//登录框tab
$('.loginAlert .title div').click(function(){
	var _this = $(this).index();
	showLoginTag(_this);
});

//注册框返回登录框
$('.goLogin').click(function(){
	$('.regAlert').hide();
	$('.loginAlert').show();
	showLoginTag(1);
});


function showLoginTag(n){
	$('.loginTitle div').eq(n).addClass('on');
	$('.loginTitle div').eq(n).siblings().removeClass('on');
	$('.loginCon div').eq(n).show();
	$('.loginCon div').eq(n).siblings().hide();
}




//非学员登录提交
$('#useLogin').click(function(){
	var _getTel = $('#useLoginTel').val();
	var _getPwd = $('#useLoginPwd').val();
	userLogin(_getTel,_getPwd);
});

//非学员登录
function userLogin(tel,pwd){

	if(tel==''||pwd=='')
	{
		alert('请填写完整资料！');
		return;
	}

	var _pwd = hex_md5(pwd);
	var regBox = {
	        regMobile : /^0?1[3|4|5|8][0-9]\d{8}$/  //手机
	    }	 
	var _mobile = tel;
	var mflag = regBox.regMobile.test(_mobile);

	var _url = 'http://120.25.228.56/user/login';


    if (!(mflag)) {
    	alert("请填写正确的手机号码");
    }else{
		$.ajax({
			url: _url,
			type: 'GET',
			dataType: 'json',
			data: {cellphone: tel,password:_pwd},
			success:function(jsonData){
				window.location.reload();
			}
		})
	}
	
}

//学员登录提交 
$('#stuLogin').click(function(){
	var _getTel = $('#stuLoginName').val();
	var _getPwd = $('#stuLoginPwd').val();
	stuLogin(_getTel,_getPwd);
});

//学员登录
function stuLogin(name,pwd){


	if(name==''||pwd=='')
	{
		alert('请填写完整资料！');
		return;
	}

	var _pwd = hex_md5(pwd);

	$.ajax({
		url: 'http://120.25.228.56/student/login',
		type: 'get',
		dataType: 'json',
		data: {username: name,password:_pwd},
		success:function(jsonData){
			if(jsonData.code === 0 ){
				window.location.reload();
			}
		}
	})	

}


//非学员注册
$('#regLogin').click(function(){
	var _regTel = $('#regTel').val();
	var _regPwd = $('#regPwd').val();
	var _regCode = $('#regCode').val();
	useRegister(_regTel,_regPwd,_regCode);
});




//非学员注册
function useRegister(tel,pwd,code){
	if(tel==''||pwd==''||code=='')
	{
		alert('请填写完整资料！');
		return;
	}

	var _pwd = hex_md5(pwd);
	var regBox = {
	        regMobile : /^0?1[3|4|5|8][0-9]\d{8}$/  //手机
	    }	 
	var _mobile = tel;
	var mflag = regBox.regMobile.test(_mobile);

	var _url = 'http://120.25.228.56/user/register';


    if (!(mflag)) {
    	alert("请填写正确的手机号码");
    }else{
		$.ajax({
			url: _url,
			type: 'POST',
			dataType: 'json',
			data: {cellphone: tel, password:_pwd, code: 123456},
			success:function(jsonData){
				if(jsonData.code ===  0){
					userLogin(_mobile,_pwd)
				} else {
					alert('注册失败！请与管理员联系');
				}
			}
		})
	}
}


$('#getMobileCode').click(function(){
	alert(123);
});



// 绑定文章弹出框

var firefox = navigator.userAgent.indexOf('Firefox') != -1;
function MouseWheel_2(e) {
///对img按下鼠标滚路，阻止视窗滚动
    e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    if (e.preventDefault) e.preventDefault();
    else e.returnValue = false;

    //其他代码
}

    


// 详情弹出

$('.article_area ul').delegate('li', 'click', function(event) {

	firefox ? document.addEventListener('DOMMouseScroll', MouseWheel_2, false) : (document.onmousewheel = MouseWheel_2);

	var _articleId = $(this).attr('data-articleId');

	console.log(_articleId);

	$.ajax({
		url : 'http://120.25.228.56/article/detail',
		data: {article_id:_articleId},
		type : 'get',
		dataType : 'json',
		success : function(dataJson){
			$('.deta_con').empty();
			$('.deta_con').html(dataJson.detail.content);

			if(dataJson.detail.multimedia_url != null && dataJson.detail.multimedia_url != ''){

				var str = '<video style="background:rgba(0,0,0,1)" width="640" height="360" controls="controls" preload="none" src="'+dataJson.detail.multimedia_url+'" name="media"></video>';
				$('.deta_con').append(str);

				setTimeout(function(){
					$('video').css('marginTop','0px');
				},0);
			}
			setTimeout(function(){
				iScroll('deta_div','deta_con','deta_bar','auto');
			},0)
			

			$('.detail_bg,.detail_div').show();
		}
	});
});

$('.detail_closed').on('click',function(){


	if(navigator.userAgent.indexOf("MSIE")>0||navigator.userAgent.indexOf("Chrome")>0)
	{
		document.onmousewheel = function()
		{
			return true;
		}
		
	}
	else
	{
		document.removeEventListener("DOMMouseScroll",stopScroll ,false);
	}
		

	//火狐下阻止鼠标滚轮事件
	function stopScroll(event) {
		event.preventDefault();	
	}

	if($('video').length > 0){
		$('video')[0].pause();
		$('video').remove();
	}
	
	$('.detail_bg,.detail_div').hide();
	$('.deta_con').empty();
});


// sum
// 详情弹出
$('.newslistDiv ul').delegate('li', 'click', function(event) {

	firefox ? document.addEventListener('DOMMouseScroll', MouseWheel_2, false) : (document.onmousewheel = MouseWheel_2);

	var _articleId = $(this).attr('data-articleId');

	//console.log(_articleId);

	$.ajax({
		url : 'http://120.25.228.56/article/detail',
		data: {article_id:_articleId},
		type : 'get',
		dataType : 'json',
		success : function(dataJson){
			$('.deta_con').empty();
			$('.deta_con').html(dataJson.detail.content);

			if(dataJson.detail.multimedia_url != null && dataJson.detail.multimedia_url != ''){
				$('.deta_title').text('如需观看视频，请使用google－chrome,firefox,ie9以上浏览器');	
				var str = '<video style="background:rgba(0,0,0,1)" width="640" height="360" controls="controls" preload="none" src="'+dataJson.detail.multimedia_url+'" name="media"></video>';
				$('.deta_con').append(str);

				setTimeout(function(){
					$('video').css('marginTop','0px');
				},1000);
			}
			setTimeout(function(){
				iScroll('deta_div','deta_con','deta_bar','auto');
			},0)
			

			$('.detail_bg,.detail_div').show();
		}
	});
});




// 作业留言

var markExNum = 0;
var markExArr = [];
var markExSub = '';

function setTeachInfo(name,time,say,arr){
	$('#teacherName').text(name);
	$('#teacherCreateTime').text(time);
	$('.teacherSaySomething').html('').html(say);

	var i = arr.length;
	var str = '';
	while(i--){
		str += '<li data-exercise="'+arr[i].exercise_id+'">'+arr[i].subject_cn+':共'+arr[i].amount+'题</li>';
	}
	$('#teacherWords').empty();
	$('#teacherWords').append(str);

}

function setSystemComment(obj,page,course){

	var opt = {
		item : 5,
		page : page,
		course : course
	}

	var obj = $('#'+obj+'');
	var _obj = obj;

	_obj.empty();
	$.ajax({
		url:'http://120.25.228.56/course/homework',
		data:opt,
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			markTopicID = dataJson.homework.topic_id;
			totalCommentPageMark = dataJson.homework.total_page;

			$('.all_num').find('span').text(dataJson.homework.total_replies);

			setTeachInfo(dataJson.homework.admin_name,dataJson.homework.create_time_formatted,dataJson.homework.thread,dataJson.homework.remark);

			if(dataJson.code === 0 && dataJson.homework.replies.length > 0){

				var i = 0;
				var data = dataJson.homework.replies;
				var limit = data.length;

				for (i; i < limit; i++) {
					writeComment(_obj,data[i].nickname,data[i].create_time_formatted,data[i].reply);

				};

			} else {
				$('.spit_page').remove();
				$('.show_talk').children('ul').append('<li style="text-align: center;font-size:24px;">暂无留言</li>');
			}
		}
	});

}





$('.btn_block').delegate('li', 'click', function(event) {

	var exercise_id = $(this).attr('data-exercise');
	$.ajax({
		url:'http://120.25.228.56/course/exercises',
		data:{exercise_id:exercise_id},
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			if(dataJson.code === 0){
				markExNum = 0;
				markExSub = dataJson.exercises.subject;
				var _link = 'http://121.40.146.153/index.php?action='+dataJson.exercises.subject+'&t_no='+dataJson.exercises.numbers_arr[0];
				$('iframe').attr('src',_link);

				markExArr = dataJson.exercises.numbers_arr;
				$('iframe')[0].contentWindow.location.href = _link;


				$('.btn_ex').css('display','inline-block');
			} else {
				alert('网络错误');
			}
			
		},
		error:function(){
			alert('网络错误');
		}
	});
});



function setExFn(num){

	if(num < 0){
		alert('已经是第一题,没有题目了哦！');
		markExNum = 0;
		return;
	} else if(num > markExArr.length) {
		markExNum = markExArr.length;
		alert('已经是最后一题,没有题目了哦！');
		return;
	}

	var str = 'http://121.40.146.153/index.php?action='+markExSub+'&t_no='+markExArr[num];
	$('iframe').attr('src',str);
	$('iframe')[0].contentWindow.location.href = str;

}

$('#btnExPre').click(function(){
	markExNum--;
	setExFn(markExNum);
});

$('#btnExNext').click(function(){
	markExNum++;
	setExFn(markExNum);
});


// 录入数据信息


function macthUrl(arr){
	var _url = window.location.href;
	var i = 0;
	var course = '';
	for(i; i < arr.length; i++){
		if(_url.indexOf(arr[i]) > -1){
			course = arr[i];
		}
	}
	return course;
}

if(_url.indexOf('system')>-1){

	var courseArr = ['gmat','gre','gaokao','ielts','sat','toefl'];
	var course = macthUrl(courseArr);

	$.ajax({
		url:'http://120.25.228.56/course/scores',
		data:{course:'sat'},
		type : 'get',
		dataType : 'json',
		async : false,
		success : function(dataJson){

			if(dataJson.code === 0){
				var str = '';
				$('#courseUserInfo').empty();

				str +=	'<span>客户资料姓名：<em>'+dataJson.realname+'</em></span>';
				str +=	'<span>账户：<em>'+dataJson.nickname+'</em></span>';

				var i = 0;
				for(i; i < dataJson.scores.length; i++){
					str += '<span>'+dataJson.scores[i].subject+':<em>'+dataJson.scores[i].yes+'</em></span>'
				}
				$('#courseUserInfo').append(str);

			} else {
				alert('用户没有登录！请注册成为学员！');
				window.location.href = '../index.html';
			}
			
		},
		error:function(){
			alert('网络错误');
		}
	});


}




// 权限控制

$('.gmatNav a,.gSunNav a').click(function(){


	var _link = $(this).attr('data-href');
	var _level = $(this).attr('data-level');

	console.log(_link+'aasdasd_---'+_level);
	if(_link == 'javascript:void(0)'){
		return;
	};


	if(userData == null && _level == '1'){
		$('.alert_bg,.loginAlert').show();
		showLoginTag(0);
		return;
	};

	if(userData == null && _level == '2' || (userData != null && userData.basic.is_student == false && _level == '2')){
		$('.alert_bg,.loginAlert').show();
		showLoginTag(1);
		return;
	};

	window.location.href = _link;

});




