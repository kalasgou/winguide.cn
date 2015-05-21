;(function($){

	'use strict';

	$.fn.creat_page = function(options){

		var b = {
			countPage:10,  //总页数
			nowPage:1,     //现在的页数
			showPage:9,    //要显示的页数
			pageClick:function(_nowPage){}		 //点击的回调函数
		};

		var ops = $.extend(b,options);

		var _countPage = parseInt(b.countPage),
			_nowPage = parseInt(b.nowPage),
			_showPage = parseInt(b.showPage),
			_thisObj = $(this);

		//创建分页
		creat(_nowPage);

		//每页点击
		_thisObj.on('click', 'a.num', function(event) {
			event.preventDefault();
			var _now = parseInt($(this).text());
			_nowPage = _now;

			creat(_nowPage);
		});

		//首页
		_thisObj.on('click', 'a.first', function(event) {
			event.preventDefault();
			_nowPage = 1;
			creat(_nowPage);
		});

		//尾页
		_thisObj.on('click', 'a.last', function(event) {
			event.preventDefault();
			_nowPage = _countPage;
			creat(_nowPage);
		});

		//上一页
		_thisObj.on('click', 'a.prev', function(event) {
			event.preventDefault();
			_nowPage--;
			if(_nowPage<=1) _nowPage=1;
			creat(_nowPage);
		});

		//下一页
		_thisObj.on('click', 'a.next', function(event) {
			event.preventDefault();
			_nowPage++;
			if(_nowPage>=_countPage) _nowPage=_countPage;
			creat(_nowPage);
		});


		function creat(n){

			var creatStr = '';
			var nPage = parseInt(n);

			//不是第一页的话
			if(n!=1){
				creatStr+='<a href="javascript:" class="first">首页</a><a href="javascript:" class="prev">上一页</a>';
			}else{
				creatStr+='<span class="noClick">首页</span><span class="noClick">上一页</span>';
			}

			//如果总页数小于显示的页数，直接把总页数遍历出来
			if(_countPage<=_showPage){
				for(var i=1;i<=_countPage;i++){
					if(i==nPage){
						creatStr+='<span>'+i+'</span>';
					}else{
						creatStr+='<a class="num" href="javascript:">'+i+'</a>';
					}
				}
			}else{
				//显示前几页，即1,2,3...n
				if(nPage<_showPage-1){
					for(var i=1;i<_showPage;i++){
						if(i==nPage){
							creatStr+='<span>'+i+'</span>';
						}else{
							creatStr+='<a class="num" href="javascript:">'+i+'</a>';
						}
						
					}
					creatStr+='...<a class="num" href="javascript:">'+_countPage+'</a>';
				}
				//显示后几页，即1...n-1,n,总
				else if(nPage>_countPage-Math.ceil(_showPage/2)){
					creatStr+='<a class="num" href="javascript:">1</a>...';
					for(var i=_countPage-_showPage+2;i<=_countPage;i++){
						if(i==nPage){
							creatStr+='<span>'+i+'</span>';
						}else{
							creatStr+='<a class="num" href="javascript:">'+i+'</a>';
						}
					}				
				}
				//显示中间几页，即1...n-1,n,n+1...总
				else{
					creatStr+='<a class="num" href="javascript:">1</a>...';

					var midShow = _showPage-2;
					var midI = Math.floor(midShow/2);
					for(var i=nPage-midI;i<=nPage+midI;i++){
						if(i==nPage){
							creatStr+='<span>'+i+'</span>';
						}else{
							creatStr+='<a class="num" href="javascript:">'+i+'</a>';
						}
					}
				
					creatStr+='...<a class="num" href="javascript:">'+_countPage+'</a>';
				}
			}						

			//不是最后一页的话
			if(n!=_countPage){
				creatStr+='<a href="javascript:" class="next">下一页</a><a href="javascript:" class="last">尾页</a>';
			}else{
				creatStr+='<span class="noClick">下一页</span><span class="noClick">尾页</span>';
			}
			

			_thisObj.empty().append(creatStr);

			b.pageClick(nPage);

		}
		
			
		
	}

})(jQuery)


/*
	自定义滚动条
	parentObj :  外层父级元素id
	boxObj    :  内容滚动层元素id
	scrollObj ： 滚动条元素id 
	scrollShow：滚动条是否显示，填hide为隐藏 ,填auto为自动，否则显示，可以不填
*/
function iScroll(parentObj,boxObj,scrollObj,scrollShow){

		var oParentDiv = document.getElementById(parentObj);
		var oTxt = document.getElementById(boxObj);

		var oBarM = document.getElementById(scrollObj);

		var oBar = oBarM.getElementsByTagName("div")[0];


		var max2 = oTxt.offsetHeight - oParentDiv.offsetHeight;


		var iScale = 0;
		var disX = 0;

		var move = 0;
		var timer = null;

		oBar.style.top = 0;
		oTxt.style.top = 0;
		iScale = 0;
		disX = 0;
		move = 0;
		timer = null;

		if(scrollShow=="hide")
		{
			oBarM.style.display = "none";
		}else if(scrollShow=="auto")
		{
			if(max2<=0)
			{
				oBarM.style.display = "none";
			}else
			{
				oBarM.style.display = "block";
			}
		}else
		{
			oBarM.style.display = "block";
		}

		var maxT = oBarM.offsetHeight - oBar.offsetHeight;
		

		//拖动滚动条
		oBar.onmousedown = function (event)
		{
			var event = event || window.event;
			disY = event.clientY - oBar.offsetTop;
			if(max2<=0) return;		
			document.onmousemove = function (event)
			{
				var event = event || window.event;
				var iL = event.clientY - disY;			
				iL <= 0 && (iL = 0);
				iL >= maxT && (iL = maxT);
				oBar.style.top = iL + "px";
				iScale = iL / maxT;		
				oTxt.style.top = -(max2 * iScale) + "px";
				return false
			};		
			document.onmouseup = function ()
			{		
				document.onmousemove = null;
				document.onmouseup = null;		
			};
			return false
		};

		//阻止滚动条点击事件冒泡
		oBar.onclick = function (event)
		{
			(event || window.event).cancelBubble = true
		}; 

		//鼠标移入滚轮事件
		oParentDiv.onmouseenter = function (event)
		{
			event = event || window.event;
			
			function mouseWheel(event)
			{
				var delta = event.wheelDelta ? event.wheelDelta : -event.detail * 40
				var iTarget = delta > 0 ? -50 : 50;

				if(max2<=0)
				{
					togetherMove(0);
				}else
				{
					togetherMove(oTxt.offsetTop - iTarget);

				}

			}

			addHandler(this, "mousewheel", mouseWheel);
			addHandler(this, "DOMMouseScroll", mouseWheel);
			
			if(max2>0)
			{
				if(navigator.userAgent.indexOf("MSIE")>0||navigator.userAgent.indexOf("Chrome")>0)
				{
					//ie下阻止鼠标滚轮事件
					document.onmousewheel = function()
					{
						return false;
					}
					
				}
				else
				{
					//火狐下阻止鼠标滚轮事件
					document.addEventListener("DOMMouseScroll",stopScroll ,false);

				}
			}
							
		};

		//鼠标移出恢复滚轮事件
		oParentDiv.onmouseleave = function()
		{
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
			
		}

		//火狐下阻止鼠标滚轮事件
		function stopScroll(event) {
			event.preventDefault();	
		}

		//图片列表和流动条同时移动
		function togetherMove(iTarget, buffer)
		{

			if (iTarget >= 0)
			{
				timer && clearInterval(timer);
				iTarget = 0
			}
			else if (iTarget <= -max2)
			{
				timer && clearInterval(timer);
				iTarget	= -max2
			}

			iScale = iTarget / max2;
			startMove(oBar, parseInt( -maxT * iScale));
			startMove(oTxt, iTarget);
		}


		function startMove(obj, iTarget)
		{
			clearInterval(obj.timer);
			obj.timer = setInterval(function ()
			{
				doMove(obj, iTarget)	
			}, 25)
		}
		function doMove(obj, iTarget, fnEnd, buffer)
		{
			var iLeft = getStyle(obj, "top");
			var iSpeed = (iTarget - iLeft) / (buffer || 5);
			iSpeed = iSpeed > 0 ? Math.ceil(iSpeed) : Math.floor(iSpeed);
			iLeft == iTarget ? (clearInterval(obj.timer), fnEnd && fnEnd()) : obj.style.top = Math.ceil(iLeft + iSpeed) + "px"
		}

		//添加鼠标滚动事件
		function addHandler(element, type, handler)
		{
			return element.addEventListener ? element.addEventListener(type, handler, false) : element.attachEvent("on" + type, handler)
		}
		function getStyle(obj, attr)
		{
			return parseFloat(obj.currentStyle ? obj.currentStyle[attr] : getComputedStyle(obj, null)[attr])	
		}
}


