$('.chose_btn_area>div').mouseenter(function(event) {
	
	$(this).find('.btn_cover').fadeIn();

});


$('.chose_btn_area>div').mouseleave(function(event) {
	
	$(this).find('.btn_cover').fadeOut();

});


$('.chose_btn_area>div').on('click',function(){
	var _link = $(this).find('.btn_cover').attr('data-href');
	window.location.href = _link;
});


var _form = $("#form");

$.each(_form.find('input'),function(index, val) {
	var vdefault = $(this).val();

	$(this).focus(function() {  
        //获得焦点时，如果值为默认值，则设置为空  
        if ($(this).val() == vdefault) {  
            $(this).val("");  
        }  
    });  

	$(this).blur(function() {  
        //失去焦点时，如果值为空，则设置为默认值  
        if ($(this).val()== "") {  
            $(this).val(vdefault); ;  
        }  
    });
	
});

//表单提交
$('#infoLogin').click(function(){

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

	$.ajax({
		url: 'http://120.25.228.56/student/activateAccount',
		type: 'POST',
		dataType: 'JSON',
		data: _dataStr,
		success:function(dataJson){
			if(dataJson.code == 0){
				alert('注册成功,请登录');
				window.location.reload();
			}else if(dataJson.code == 3){
				alert('该用户不存在！');
			} else {
				alert('注册失败,请检查');
			}
		},
		error:function(){
			alert('网络异常');
		}
	});
	


});



$('.mm_btn_2').click(function(){

	window.location.href = 'http://www.winguide.cn/manage/login'

});

// $('.alert_bg').click(function(){
// 	$('.alert_bg,.formDiv').hide();
// });