/*
	自定义滚动条
	parentObj :  外层父级元素id
	boxObj    :  内容滚动层元素id
	scrollObj ： 滚动条元素id 
	scrollShow：滚动条是否显示，填hide为隐藏 ,填auto为自动，否则显示，可以不填
*/

var firefox = navigator.userAgent.indexOf('Firefox') != -1;
function MouseWheel_2(e) {
///对img按下鼠标滚路，阻止视窗滚动
///
	console.log(2)
    var e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    else e.cancelBubble = true;
    if (e.preventDefault) e.preventDefault();
    else e.returnValue = false;

    //其他代码
}


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
			// if(navigator.userAgent.indexOf("MSIE")>0||navigator.userAgent.indexOf("Chrome")>0)
			// {
			// 	document.onmousewheel = function()
			// 	{
			// 		return true;
			// 	}
				
			// }
			// else
			// {
			// 	document.removeEventListener("DOMMouseScroll",stopScroll ,false);
			// }
			// 
			console.log(1)
			firefox ? document.addEventListener('DOMMouseScroll', MouseWheel_2, false) : (document.onmousewheel = MouseWheel_2);
			
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


