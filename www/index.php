<?php  session_start();  error_reporting(-1);	//error_reporting(7 -1);  121.40.146.153
echo "<!doctype html><html><head><meta charset=\"utf-8\"></head><body bgcolor=\"#9EB6D8\"><style>";
echo ".ua{color:#FF0000; border-bottom:1px solid #FF0000}";	// 红
echo ".ub{color:#0000FF; border-bottom:1px solid #0000FF}";	// 蓝
echo ".uc{color:#FF00FF; border-bottom:1px solid #FF00FF}";	// 紫
echo ".ud{color:#FFFF00; border-bottom:1px solid #FFFF00}";	// 黄
echo ".cr{background-color:#F00}";				// 文字红色
echo ".cg{background-color:#0F0}";				// 文字绿色
echo ".cb{background-color:#00F}";				// 文字蓝色
echo ".cy{background-color:#FF0}</style>";	// 文字黄色
function Login_Form(){
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"Login\">
			<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"260\" align=\"center\" style=\"border: 1px solid #698CC3\" bgcolor=\"#D6E0EF\">
			<tr><td colspan=\"2\" height=\"24\" align=\"center\" bgcolor=\"#698CC3\"><nobr><b><font color=\"#FFFFFF\">Login</font></b></nobr></td></tr>
			<tr><td>Username: <input type=\"text\"     name=\"i_username\" size=\"20\" maxlength=\"20\" value=\"\"></td></tr>
			<tr><td>Password: <input type=\"password\" name=\"i_password\" size=\"20\" maxlength=\"20\"></td></tr>
			<tr><td colspan=\"2\" align=\"center\" bgcolor=\"#8BAEE5\"><input type=\"submit\" value=\"Login\"></td></tr></table></form>";
}
function Main_Menu(){ $userid=$_SESSION['userid'];
	echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"320\" align=\"center\" style=\"border: 1px solid #698CC3\" bgcolor=\"#D6E0EF\">
		  <tr><td colspan=\"2\" height=\"24\" align=\"center\" bgcolor=\"#698CC3\"><nobr><b><font color=\"#FFFFFF\">MainMenu</font></b></nobr></td></tr>";
	if(strncmp($userid, "sat", 3)==0){
		$s1="<tr><td align=\"center\"><a href=\"index.php?action=";  $s2="</a></td></tr>";
		echo $s1."单词视频\">SAT单词视频".$s2;
		echo $s1."单词练习\">SAT单词练习".$s2;
		echo $s1."单词填空\">SAT单词填空".$s2;
		echo $s1."语法视频\">SAT语法视频".$s2;
		echo $s1."语法练习\">SAT语法练习".$s2;
		echo $s1."语法测验\">SAT语法测验".$s2;
		echo $s1."Quit\">Quit".$s2."</table>";
	}else{
		$s1="<tr><td align=\"left\"><a href=\"index.php?action=";  $s2="</a></td><td align=\"left\"><a href=\"index.php?action=";  $s3="</a></td></tr>";
		echo $s1."单词视频\">SAT单词视频".$s2."托福单词练习\">托福单词练习".$s3;
		echo $s1."单词练习\">SAT单词练习".$s2."托福SVO1\">托福句子选择SVO".$s3;
		echo $s1."单词填空\">SAT单词填空".$s2."托福SV\">托福SV替换练习".$s3;
		echo $s1."语法视频\">SAT语法视频".$s2."托福SVO2\">托福原句改写对应SVO".$s3;
		echo $s1."语法练习\">SAT语法练习".$s2."托福SVO3\">托福抽象具体练习".$s3;
		echo $s1."语法测验\">SAT语法测验".$s2."托福SVO4\">托福指代练习".$s3;
		echo $s1."SAT_math1\">SAT数学(1)分类".$s2."高考1\">高考单选题".$s3;
		echo $s1."SAT_math2\">SAT2014MAY".$s2."高考2\">高考多选题".$s3;
		echo $s1."SAT_math3\">SAT2014JAN".$s2."高考单词\">高考单词".$s3;
		echo $s1."SAT_math4\">SAT2013JAN".$s2."SAT_math5\">SAT2013OCT".$s3;
//		echo $s1."Quit\">Quit".$s2."高考单词\">高考单词".$s3."</table>";
		echo $s1."Quit\">Quit".$s3."</table>";
	}
}
function Fun_Log1($name, $t_no, $choice, $answer){//单选LOG
	global $db;  $userid=$_SESSION['userid'];  $dt=date('Y-m-d H:i:s', time());
	$sql="INSERT INTO Log_all (userid, datetime, t_type, t_no, choice, answer) values('$userid', '$dt', '$name', '$t_no', '$choice', '$answer')";  $db->query($sql);
}
function Fun_Answer1($name, $dbn, $ts){//单选题答案
	global $db;  $userid=$_SESSION['userid'];  $t_no=$_SESSION['timu_no'];  $answer=$_SESSION['answer'];  echo "<table width=\"40%\" align=\"center\"><tr><td>";
	if(!isset($_POST['choice'])){ echo "请选择一个正确答案</td></tr>";
		echo "<tr><td><br><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr></table>";  return; }
	$choice=$_POST['choice'];  Fun_Log1($name, $t_no, $choice, $answer);
	$sql="SELECT * FROM ".$dbn." where timu_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $n=$q->num_rows;
	if($answer==$_POST['choice']){// 正确
		if($n>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];  $sql="UPDATE ".$dbn." set yes=$yes where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '1', '0')";  $db->query($sql); }  $t_no=$t_no+1;
		echo "正确<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">下一题</a></td><td><a href=\"index.php?action=Login\">返回主菜单</a></td></tr></table>";
	}else{// 错误
		if($n>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];  $sql="UPDATE ".$dbn." set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '0', '1')";  $db->query($sql); }
		echo "错误<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr></table>";
	}
	if(strlen($ts)>2) echo "<table width=\"40%\" align=\"center\"><tr><td>知识点提示：<br>$ts</td></tr></table>";
}

function Fun_Answer2($name, $dbn, $ts){//多选题答案
	global $db;  $userid=$_SESSION['userid'];  $t_no=$_SESSION['timu_no'];  $answer=$_SESSION['answer'];  echo "<table width=\"40%\" align=\"center\"><tr><td>";
	if(!isset($_POST['choice'])){ echo "请选择一个正确答案</td></tr>";
		echo "<tr><td><br><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr></table>";  return; }
	$ch=$_POST['choice'];  $num=0;  for($i=0; $i<count($ch); $i++) $num+=$ch[$i];
	Fun_Log1($name, $t_no, $num, $answer);
	$sql="SELECT * FROM ".$dbn." where timu_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $n=$q->num_rows;
	if($answer==$num){// 正确
		if($n>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];  $sql="UPDATE ".$dbn." set yes=$yes where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '1', '0')";  $db->query($sql); }  $t_no=$t_no+1;
		echo "正确<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">下一题</a></td><td><a href=\"index.php?action=Login\">返回主菜单</a></td></tr></table>";
	}else{// 错误
		if($n>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];  $sql="UPDATE ".$dbn." set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '0', '1')";  $db->query($sql); }
		echo "错误<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr></table>";
	}
	if(strlen($ts)>2) echo "<table width=\"40%\" align=\"center\"><tr><td>知识点提示：<br>$ts</td></tr></table>";
}
function Calc_7($a1, $a2, $a3){
	if($a1==1 && $a2==1 && $a3==1)  $ra=7;
	else if($a1==1 && $a2==1)  $ra=4;
	else if($a1==1 && $a3==1)  $ra=5;
	else if($a2==1 && $a3==1)  $ra=6;
	else if($a1==1)  $ra=1;
	else if($a2==1)  $ra=2;
	else $ra=3;  return $ra;
}
function Show_head($name, $dispname, $dbname, $tjname){
	global $db, $timu, $d, $q;  $userid=$_SESSION['userid'];
	if(isset($_REQUEST['t_no'])){ $t_no=intval($_REQUEST['t_no']);	// 题目已定义
		$sql="SELECT * FROM ".$tjname." where userid='$userid' and timu_no='$t_no'";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong']; }else{ $yes=0;  $err=0; }
	}else{ $sql="SELECT * FROM ".$tjname." where userid='$userid' order by timu_no desc";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $t_no=intval($d['timu_no']); }else{ $yes=0;  $err=0;  $t_no=1; }
	}
	$q->free();  $q=$db->query("SELECT count(*) FROM ".$dbname);  $d=$q->fetch_array();  $max_num=$d[0];  $q->free();  if($t_no<1){ $t_no=1; }
	if($t_no>$max_num){ $t_no=$max_num; }  $t_1=$t_no+1;  if($t_1>$max_num){ $t_1=$max_num; }  $t_0=$t_no-1;  if($t_0<1){ $t_0=1; }
	$q=$db->query("SELECT * FROM ".$dbname." where no=$t_no");  $d=$q->fetch_array();  $timu=$d['timu'];
	$timu=str_replace("<cr>", "<span class=\"cr\">", $timu);  $timu=str_replace("</cr>", "</span>", $timu);
	$timu=str_replace("<cg>", "<span class=\"cg\">", $timu);  $timu=str_replace("</cg>", "</span>", $timu);
	$timu=str_replace("<cb>", "<span class=\"cb\">", $timu);  $timu=str_replace("</cb>", "</span>", $timu);
	$timu=str_replace("<cy>", "<span class=\"cy\">", $timu);  $timu=str_replace("</cy>", "</span>", $timu);
	$timu=str_replace("<ua>", "<span class=\"ua\">", $timu);  $timu=str_replace("</ua>", "</span>", $timu);
	$timu=str_replace("<ub>", "<span class=\"ub\">", $timu);  $timu=str_replace("</ub>", "</span>", $timu);
	$timu=str_replace("<uc>", "<span class=\"uc\">", $timu);  $timu=str_replace("</uc>", "</span>", $timu);
	$timu=str_replace("<ud>", "<span class=\"ud\">", $timu);  $timu=str_replace("</ud>", "</span>", $timu);
	echo "<table width=\"50%\" align=\"center\"><tr><td>$userid $dispname: $t_no 题目总数=$max_num 对=$yes 错=$err</td></tr><tr><td>";
	echo "<a href=\"index.php?action=$name&t_no=$t_0\">上一题</a>&nbsp &nbsp<a href=\"index.php?action=$name&t_no=$t_1\">下一题</a>&nbsp &nbsp";
	echo "<a href=\"index.php?action=Login\">返回</a></td></tr>";  $_SESSION['timu_no']=$t_no;
}
function Fun_Math1($name, $dbn){// 单选题答案
	global $db;  $userid=$_SESSION['userid'];  $t_no=$_SESSION['timu_no'];  $answer=$_SESSION['answer'];  $timu=$_SESSION['timu_math'];
	if(!isset($_POST['choice'])){ echo "<table width=\"40%\" align=\"center\"><tr><td>请选择一个正确答案</td></tr>";
		echo "<tr><td><br><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr></table>";  return; }
	$choice=$_POST['choice'];  Fun_Log1($name, $t_no, $choice, $answer);
	$sql="SELECT * FROM ".$dbn." where timu_no='$t_no' and userid='$userid'";
	$q=$db->query($sql);  $max_num=$q->num_rows;
	if($answer==$_POST['choice']){// 正确
		if($max_num>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];
			$sql="UPDATE ".$dbn." set yes=$yes where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '1', '0')";  $db->query($sql); }  $t_no=$t_no+1;
		echo "<table width=\"50%\" align=\"center\"><tr><td>正确<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">下一题</a> ";
		echo "&nbsp <a href=\"index.php?action=Login\">返回主菜单</a></td></tr>";
	}else{// 错误
		if($max_num>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];  $sql="UPDATE ".$dbn." set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO ".$dbn."(timu_no, userid, yes, wrong) values('$t_no', '$userid', '0', '1')";  $db->query($sql); }
		echo "<table width=\"50%\" align=\"center\"><tr><td>错误<br></td></tr><tr><td><a href=\"index.php?action=$name&t_no=$t_no\">继续</a></td></tr>";
	}
	echo "<tr><td><img src=\"$timu\" width='80%'/></td><tr><tr><td>知识点提示：</td></tr>";  $t=$_SESSION[$_POST['choice']];  echo "<tr><td>$t</td></tr></table>";
}
function Fun_WriteRGB($ss){
	$s="<input type=\"radio\" name=\"choice\" value=";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"$ss\"><tr><td>";
	echo "$s\"1\"><span class=\"ua\">红</span> $s\"2\"><span class=\"ub\">蓝</span> $s\"3\"><span class=\"uc\">紫</span> ";
	echo "$s\"4\"><span class=\"ua\">红</span>+<span class=\"ub\">蓝</span> ";
	echo "$s\"5\"><span class=\"ua\">红</span>+<span class=\"uc\">紫</span> ";
	echo "$s\"6\"><span class=\"ub\">蓝</span>+<span class=\"uc\">紫</span> ";
	echo "$s\"7\"><span class=\"ua\">红</span>+<span class=\"ub\">蓝</span>+<span class=\"uc\">紫</span><br>";
	echo "<br><input type=\"submit\" name=\"\" value=\"提交\"></td></tr></form></table>";
}
function Fun_tail(){
	echo "<br><input type=\"submit\" name=\"\" value=\"提交\"></td></tr></form></table>";
}

$db=new mysqli("localhost", "root", "TOPtraining888", "sat_db");  $db->query("set names utf8");
$action=(empty($_REQUEST['action'])) ? '' : $_REQUEST['action'];
if(!isset($_SESSION['userid']) && empty($action)){ $action="logon"; }

switch($action){
case "高考单词": Show_head("高考单词", "高考单词", "gk_danci", "gktj_danci");  $s1=$d['name'];  $_SESSION['dc_name']=$s1;  $an=$d['chinese'];
	echo "<tr><td><br></td></tr><tr><td>$s1</td><tr><tr><td><br>请选择中文解释:</td></tr><tr><td>";
	$ra=array();  $ra[]=$d['cn1'];  $ra[]=$d['cn2'];  $ra[]=$d['cn3'];  $ra[]=$d['cn4'];  $ra[]=$an;  shuffle($ra);
	for($i=0; $i<5; $i++){ if($ra[$i]==$an) break; }  $_SESSION['answer']=$i+1;  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"高考单词答案\"><tr><td>";
	echo "$s\"1\"> $ra[0]<br>$s\"2\"> $ra[1]<br>$s\"3\"> $ra[2]<br>$s\"4\"> $ra[3]<br>$s\"5\"> $ra[4]<br>";
	Fun_tail();  break;
case "高考单词答案": Fun_Answer1("高考单词", "gktj_danci", "");  break;

case "高考1"://高考单选题
	Show_head("高考1", "高考单选题", "gk_1", "gktj_1");  $_SESSION['answer']=$d['answer'];  $timu2=$d['timu2'];  $_SESSION['gk_tishi']=$d['tishi'];
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br></td></tr><tr><td>$timu2</td><tr><br>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"高考1答案\"><tr><td>";
	$x1=$d['ch1'];  $x2=$d['ch2'];  $x3=$d['ch3'];  $x4=$d['ch4'];  $q->free();  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "$s\"1\"> $x1<br>$s\"2\"> $x2<br>$s\"3\"> $x3<br>$s\"4\"> $x4<br>";  Fun_tail();  break;
case "高考1答案": $ts=$_SESSION['gk_tishi'];  Fun_Answer1("高考1", "gktj_1", $ts);  break;

case "高考2"://高考多选题
	Show_head("高考2", "高考多选题", "gk_2", "gktj_2");  $_SESSION['answer']=$d['answer'];  $timu2=$d['timu2'];  $_SESSION['gk_tishi']=$d['tishi'];
	$timu2=str_replace("<cr>", "<span class=\"cr\">", $timu2);  $timu2=str_replace("</cr>", "</span>", $timu2);
	$timu2=str_replace("<cg>", "<span class=\"cg\">", $timu2);  $timu2=str_replace("</cg>", "</span>", $timu2);
	$timu2=str_replace("<cb>", "<span class=\"cb\">", $timu2);  $timu2=str_replace("</cb>", "</span>", $timu2);
	$timu2=str_replace("<cy>", "<span class=\"cy\">", $timu2);  $timu2=str_replace("</cy>", "</span>", $timu2);
	$timu2=str_replace("<ua>", "<span class=\"ua\">", $timu2);  $timu2=str_replace("</ua>", "</span>", $timu2);
	$timu2=str_replace("<ub>", "<span class=\"ub\">", $timu2);  $timu2=str_replace("</ub>", "</span>", $timu2);
	$timu2=str_replace("<uc>", "<span class=\"uc\">", $timu2);  $timu2=str_replace("</uc>", "</span>", $timu2);
	$timu2=str_replace("<ud>", "<span class=\"ud\">", $timu2);  $timu2=str_replace("</ud>", "</span>", $timu2);
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br></td></tr><tr><td>$timu2</td><tr><br>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"高考2答案\"><tr><td>";
	$s="<input type=\"checkbox\" name=\"choice[]\" value=";
	$x1="<span class=\"ua\">红</span>";  $x2="<span class=\"ub\">蓝</span>";  $x3="<span class=\"uc\">紫</span>";  $x4="<span class=\"ud\">黄</span>";
	echo "$s\"1\"> $x1 &nbsp $s\"2\"> $x2 &nbsp $s\"4\"> $x3 &nbsp $s\"8\"> $x4";  Fun_tail();  break;
case "高考2答案": $ts=$_SESSION['gk_tishi'];  Fun_Answer2("高考2", "gktj_2", $ts);  break;

case "SAT_math1"://SAT数学(1)分类
	Show_head("SAT_math1", "SAT数学(1)分类", "sat_math1", "sattj_math1");  $_SESSION['answer']=$d['answer'];  $_SESSION['timu_math']="png/1/".$d['timu'].".png";
	$_SESSION['A']=$d['ch1'];  $_SESSION['B']=$d['ch2'];  $_SESSION['C']=$d['ch3'];  $_SESSION['D']=$d['ch4'];  $_SESSION['E']=$d['ch5'];  $q->free();
	echo "<tr><td>请选择正确答案:</td></tr><tr><td><br></td></tr>";  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<tr><td><img src=\"png/1/$timu.png\" width='80%'/></td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"SAT_math1答案\"><tr><td>";
	echo "$s\"A\">A &nbsp $s\"B\">B &nbsp $s\"C\">C &nbsp $s\"D\">D &nbsp $s\"E\">E<br>";  Fun_tail();  break;
case "SAT_math1答案":  Fun_Math1("SAT_math1", "sattj_math1");  break;

case "SAT_math2"://SAT数学(2)
	Show_head("SAT_math2", "SAT数学(2)", "sat_math2", "sattj_math2");  $_SESSION['answer']=$d['answer'];  $_SESSION['timu_math']="png/2/".$d['timu'].".png";
	$_SESSION['A']=$d['ch1'];  $_SESSION['B']=$d['ch2'];  $_SESSION['C']=$d['ch3'];  $_SESSION['D']=$d['ch4'];  $_SESSION['E']=$d['ch5'];  $q->free();
	echo "<tr><td>请选择正确答案:</td></tr><tr><td><br></td></tr>";  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<tr><td><img src=\"png/2/$timu.png\" width='80%'/></td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"SAT_math2答案\"><tr><td>";
	echo "$s\"A\">A &nbsp $s\"B\">B &nbsp $s\"C\">C &nbsp $s\"D\">D &nbsp $s\"E\">E<br>";  Fun_tail();  break;
case "SAT_math2答案":  Fun_Math1("SAT_math2", "sattj_math2");  break;

case "SAT_math3"://SAT数学(3)
	Show_head("SAT_math3", "SAT数学(3)", "sat_math3", "sattj_math3");  $_SESSION['answer']=$d['answer'];  $_SESSION['timu_math']="png/3/".$d['timu'].".png";
	$_SESSION['A']=$d['ch1'];  $_SESSION['B']=$d['ch2'];  $_SESSION['C']=$d['ch3'];  $_SESSION['D']=$d['ch4'];  $_SESSION['E']=$d['ch5'];  $q->free();
	echo "<tr><td>请选择正确答案:</td></tr><tr><td><br></td></tr>";  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<tr><td><img src=\"png/3/$timu.png\" width='80%'/></td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"SAT_math3答案\"><tr><td>";
	echo "$s\"A\">A &nbsp $s\"B\">B &nbsp $s\"C\">C &nbsp $s\"D\">D &nbsp $s\"E\">E<br>";  Fun_tail();  break;
case "SAT_math3答案":  Fun_Math1("SAT_math3", "sattj_math3");  break;

case "SAT_math4"://SAT数学(4)
	Show_head("SAT_math4", "SAT数学(4)", "sat_math4", "sattj_math4");  $_SESSION['answer']=$d['answer'];  $_SESSION['timu_math']="png/4/".$d['timu'].".png";
	$_SESSION['A']=$d['ch1'];  $_SESSION['B']=$d['ch2'];  $_SESSION['C']=$d['ch3'];  $_SESSION['D']=$d['ch4'];  $_SESSION['E']=$d['ch5'];  $q->free();
	echo "<tr><td>请选择正确答案:</td></tr><tr><td><br></td></tr>";  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<tr><td><img src=\"png/4/$timu.png\" width='80%'/></td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"SAT_math4答案\"><tr><td>";
	echo "$s\"A\">A &nbsp $s\"B\">B &nbsp $s\"C\">C &nbsp $s\"D\">D &nbsp $s\"E\">E<br>";  Fun_tail();  break;
case "SAT_math4答案":  Fun_Math1("SAT_math4", "sattj_math4");  break;

case "SAT_math5"://SAT数学(5)
	Show_head("SAT_math5", "SAT数学(5)", "sat_math5", "sattj_math5");  $_SESSION['answer']=$d['answer'];  $_SESSION['timu_math']="png/5/".$d['timu'].".png";
	$_SESSION['A']=$d['ch1'];  $_SESSION['B']=$d['ch2'];  $_SESSION['C']=$d['ch3'];  $_SESSION['D']=$d['ch4'];  $_SESSION['E']=$d['ch5'];  $q->free();
	echo "<tr><td>请选择正确答案:</td></tr><tr><td><br></td></tr>";  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "<tr><td><img src=\"png/5/$timu.png\" width='80%'/></td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"SAT_math5答案\"><tr><td>";
	echo "$s\"A\">A &nbsp $s\"B\">B &nbsp $s\"C\">C &nbsp $s\"D\">D &nbsp $s\"E\">E<br>";  Fun_tail();  break;
case "SAT_math5答案":  Fun_Math1("SAT_math5", "sattj_math5");  break;

case "托福SVO4"://托福指代练习
	Show_head("托福SVO4", "托福指代练习", "tf_svo4", "tftj_svo4");  $_SESSION['answer']=Calc_7($d['a'], $d['b'], $d['c']);  $q->free();
	echo "<tr><td>请选择句中绿色部分所指代的内容:</td></tr><tr><td><br></td></tr>";
	echo "<tr><td>$timu</td><tr><tr><td><br></td></tr>";  Fun_WriteRGB("托福SVO4答案");  break;
case "托福SVO4答案":  Fun_Answer1("托福SVO4", "tftj_svo4", "");  break;

case "托福SVO3"://托福抽象具体练习
	Show_head("托福SVO3", "托福抽象具体练习", "tf_svo3", "tftj_svo3");  $_SESSION['answer']=Calc_7($d['a'], $d['b'], $d['c']);  $q->free();
	if($d['mode']=="2")  echo "<tr><td>请选出与句中绿色字体部分相对应的抽象词（概念）:</td></tr>";
	else						echo "<tr><td>请选出与句中绿色字体部分相对应的具体描述:</td></tr>";
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br></td></tr>";  Fun_WriteRGB("托福SVO3答案");  break;
case "托福SVO3答案":  Fun_Answer1("托福SVO3", "tftj_svo3", "");  break;

case "托福SVO2"://托福原句和改写句中选择对应SVO
	Show_head("托福SVO2", "托福SVO2", "tf_svo2", "tftj_svo2");  $timu2=$d['timu2'];  $_SESSION['answer']=Calc_7($d['a'], $d['b'], $d['c']);
	if($d['mode']=="S") echo "<tr><td>原句（主语）</td></tr>";
	if($d['mode']=="V") echo "<tr><td>原句（动词）</td></tr>";
	if($d['mode']=="O") echo "<tr><td>原句（宾语）</td></tr>";
	echo "<tr><td>$timu</td><tr><tr><td>请选择对应原句绿色字体部分:</td></tr>";
	$timu2=str_replace("<ua>", "<span class=\"ua\">", $timu2);  $timu2=str_replace("</ua>", "</span>", $timu2);
	$timu2=str_replace("<ub>", "<span class=\"ub\">", $timu2);  $timu2=str_replace("</ub>", "</span>", $timu2);
	$timu2=str_replace("<uc>", "<span class=\"uc\">", $timu2);  $timu2=str_replace("</uc>", "</span>", $timu2);
	echo "<tr><td>$timu2</td><tr><tr><td><br>请选择正确答案:</td></tr>";  Fun_WriteRGB("托福SVO2答案");  $q->free();  break;
case "托福SVO2答案":  Fun_Answer1("托福SVO2", "tftj_svo2");  break;

case "托福SV"://托福SV替换练习
	Show_head("托福SV", "托福SV替换练习", "tf_svo15", "tftj_svo15");  $_SESSION['answer']=$d['answer'];
	if($d['mode']=="S")       echo "<tr><td>请选择与下面句子主语含义相同的替换句:</td></tr>";
	else if($d['mode']=="V")  echo "<tr><td>请选择与下面句子谓语含义相同的替换句:</td></tr>";
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br></td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"托福SV答案\"><tr><td>";
	$x1=$d['ch1'];  $x2=$d['ch2'];  $x3=$d['ch3'];  $x4=$d['ch4'];  $q->free();  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "$s\"1\"> $x1<br>$s\"2\"> $x2<br>$s\"3\"> $x3<br>$s\"4\"> $x4<br>";  Fun_tail();  break;
case "托福SV答案":  Fun_Answer1("托福SV", "tftj_svo15", "");  break;

case "托福SVO1"://托福句子选择SVO
	Show_head("托福SVO1", "托福SVO1", "tf_svo1", "tftj_svo1");  $_SESSION['answer']=Calc_7($d['a'], $d['b'], $d['c']);
	if($d['mode']=="S") echo "<tr><td>在句子中选主语:</td></tr>";
	if($d['mode']=="V") echo "<tr><td>在句子中选谓语:</td></tr>";
	if($d['mode']=="O") echo "<tr><td>在句子中选宾语:</td></tr>";
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br>请选择正确答案:</td></tr>";  Fun_WriteRGB("托福SVO1答案");  $q->free();  break;
case "托福SVO1答案":  Fun_Answer1("托福SVO1", "tftj_svo1");  break;

case "托福单词练习":
	Show_head("托福单词练习", "托福单词练习", "tf_danci", "tftj_danci");  $_SESSION['answer']=$d['answer'];
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br>请选择正确答案:</td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"托福单词答案\"><tr><td>";
	$x1=$d['xuan1'];  $x2=$d['xuan2'];  $x3=$d['xuan3'];  $x4=$d['xuan4'];  $q->free();  $s="<input type=\"radio\" name=\"choice\" value=";
	echo "$s\"1\"> $x1<br>$s\"2\"> $x2<br>$s\"3\"> $x3<br>$s\"4\"> $x4<br>";  Fun_tail();  break;
case "托福单词答案":  Fun_Answer1("托福单词练习", "tftj_danci", "");  break;

case "语法练习":  $userid=$_SESSION['userid'];	// 选择正确答案和错误答案的错误类型, 先把语法错误类型表保存到数组, y_num=语法类型总数
	if(isset($_REQUEST['t_no'])){ $t_no=intval($_REQUEST['t_no']);	// 题目已定义
		$sql="SELECT * FROM sat_yflxtj where userid='$userid' and yufa_no='$t_no'";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $errtype=$d['errtype']; }else{ $yes=0;  $err=0;  $errtype=""; }
	}else{ $sql="SELECT * FROM sat_yflxtj where userid='$userid' order by yufa_no desc";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $errtype=$d['errtype'];  $t_no=intval($d['yufa_no']); }
		else{ $yes=0;  $err=0;  $errtype="";  $t_no=1; }
	}  $q->free();  $q=$db->query("SELECT count(*) FROM sat_yufa");  $d=$q->fetch_array();  $max_num=$d[0];  $q->free();// 计算语法选择题目总数
	if($t_no<1){ $t_no=1; }  if($t_no>$max_num){ $t_no=$max_num; }  $t_1=$t_no+1;  if($t_1>$max_num){ $t_1=$max_num; }
	$t_0=$t_no-1;  if($t_0<1){ $t_0=1; }  $q=$db->query("SELECT * FROM sat_yufa where no=$t_no");  $d=$q->fetch_array();  $timu=$d['timu'];
	echo "<table width=\"50%\" align=\"center\"><tr><td>$userid 语法练习: $t_no 题目总数=$max_num 对=$yes 错=$err</td></tr><tr><td>";
	echo "<a href=\"index.php?action=语法练习&t_no=$t_0\">上一题</a>&nbsp &nbsp<a href=\"index.php?action=语法练习&t_no=$t_1\">下一题</a>&nbsp &nbsp";
	echo "<a href=\"index.php?action=Login\">返回</a>";
	echo "</td></tr><tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br>请选择正确答案和错误答案的错误类型</td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\">	<input type=\"hidden\" name=\"action\" value=\"语法练习答案\">";
	$op=array('"yufa_opt1"', '"yufa_opt2"', '"yufa_opt3"', '"yufa_opt4"', '"yufa_opt5"');  $o=array("","正确");  $ol=2;
	$ch=array($d['choice1'], $d['choice2'], $d['choice3'], $d['choice4'], $d['choice5']);	// ch=选项
	$an=array($d['answer1'], $d['answer2'], $d['answer3'], $d['answer4'], $d['answer5']);	// an=答案(错误类型)
	for($i=0; $i<5; $i++){ if($an[$i]=="ok") $an[$i]="正确"; }  $ca=array_combine($ch, $an);  //shuffle($ch);	// ca=选项对应的答案, ch打乱顺序
	$cb=array();  for($i=0; $i<5; $i++){ $cb[$ch[$i]]=$ca[$ch[$i]]; }	// cb=乱序后的选项对应的答案
	$_SESSION['yflx_no']=$t_no;  $_SESSION['timu']=$timu;  $_SESSION['ch']=$ch;  $_SESSION['cb']=$cb;  reset($cb);	// 题号,题目,选项,答案
	for($i=0; $i<5; $i++){
		for($j=0; $j<$ol; $j++){ if($an[$i]=="正确")  continue;
			if($an[$i]!=$o[$j]){ $o[]=$an[$i];  $ol++;  break;	}
		}
	}
	for($i=0; $i<5; $i++){ $k=key($cb);  $v=$cb[$k];  next($cb);  echo "<tr><td>$k</td><td><select name=$op[$i]>";	// k=选项, v=答案
		for($j=0; $j<$ol; $j++){ echo "<OPTION value=$o[$j]>$o[$j]</OPTION>"; }  echo "</select></td></tr><tr><td><br></td></tr>";
	}  echo "<tr><td><br><input type=\"submit\" name=\"\" value=\"提交\"></td></tr></form></table>";  break;
case "语法练习答案":  $op=array($_POST['yufa_opt1'], $_POST['yufa_opt2'], $_POST['yufa_opt3'], $_POST['yufa_opt4'], $_POST['yufa_opt5']);
	$userid=$_SESSION['userid'];  $t_no=$_SESSION['yflx_no'];  $timu=$_SESSION['timu'];  $ch=$_SESSION['ch'];  $cb=$_SESSION['cb'];  $an=array_values($cb);
	$sql="SELECT * FROM sat_yflxtj where yufa_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $max_num=$q->num_rows;
	for($i=$c=$k=0; $i<5; $i++){ if($op[$i]=="正确"){ $c++;  if($an[$i]=="正确") $k=1; }}
	if($c!=1){ echo "<table width=\"40%\" align=\"center\"><tr><td>只能选择一个正确答案</td></tr><tr><td><br>";
				  echo "<a href=\"index.php?action=语法练习&t_no=$t_no\">继续</a></td></tr></table>";  break; }
	if($k!=1){
		if($max_num>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];  $sql="UPDATE sat_yflxtj set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO sat_yflxtj(yufa_no, userid, yes, wrong, errtype) values('$t_no', '$userid', '0', '1', '')";  $db->query($sql); }
		echo "<table width=\"40%\" align=\"center\"><tr><td>答案错误</td></tr><tr><td><br>";
		echo "<a href=\"index.php?action=语法练习&t_no=$t_no\">继续</a></td></tr></table>";  break;
	}
	if($max_num>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];
		$sql="UPDATE sat_yflxtj set yes=$yes where no=$no";  $db->query($sql);
	}else{ $sql="INSERT INTO sat_yflxtj(yufa_no, userid, yes, wrong, errtype) values('$t_no', '$userid', '1', '0', '')";  $db->query($sql); }  $t_no=$t_no+1;
	echo "<table width=\"50%\" align=\"center\"><tr><td>答案正确</td></tr><tr><td>";
	echo "<a href=\"index.php?action=语法练习&t_no=$t_no\">下一题</a>&nbsp &nbsp<a href=\"index.php?action=Login\">返回主菜单</a></td></tr>";
	echo "<tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br></td></tr>";
	for($i=0; $i<5; $i++){ if($an[$i]=="正确" || $an[$i]=="错误"){ $s1=""; $s=$an[$i]; }else{ $s1=$an[$i];  $s=" "; }
		echo "<tr><td>$ch[$i]</td><td><select><OPTION>$s1 $s</OPTION></select></td></tr><tr><td><br></td></tr>";
	}	echo "</table>";
	break;

case "单词练习":  $userid=$_SESSION['userid'];
	if(isset($_REQUEST['t_no'])){ $t_no=intval($_REQUEST['t_no']);	// 题目已定义
		$sql="SELECT * FROM sat_dctj where userid='$userid' and danci_no='$t_no'";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong']; }else{ $yes=0;  $err=0; }
	}else{ $sql="SELECT * FROM sat_dctj where userid='$userid' order by danci_no desc";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $t_no=intval($d['danci_no']); }else{ $yes=0;  $err=0;  $t_no=1; }
	}
	$q->free();  $q=$db->query("SELECT count(*) FROM sat_danci");  $d=$q->fetch_array();  $max_num=$d[0];  $q->free();  if($t_no<1){ $t_no=1; }
	if($t_no>$max_num){ $t_no=$max_num; }  $t_1=$t_no+1;  if($t_1>$max_num){ $t_1=$max_num; }  $t_0=$t_no-1;  if($t_0<1){ $t_0=1; }
	$q=$db->query("SELECT * FROM sat_danci where no=$t_no");  $d=$q->fetch_array();  $s1=$d['name']." ".$d['yinbiao'];  $_SESSION['dc_name']=$s1;
	echo "<table width=\"40%\" align=\"center\"><tr><td>$userid 单词练习: $t_no 单词总数=$max_num 对=$yes 错=$err</td></tr><tr><td>";
	echo "<a href=\"index.php?action=单词练习&t_no=$t_0\">上一题</a>&nbsp &nbsp<a href=\"index.php?action=单词练习&t_no=$t_1\">下一题</a>&nbsp &nbsp";
	echo "<a href=\"index.php?action=Login\">返回</a></td></tr><tr><td><br></td></tr><tr><td>$s1</td><tr><tr><td><br>请选择中文解释:</td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"单词练习答案\">";
	$ra=array();  $ra[]=$d['cn1'];  $ra[]=$d['cn2'];  $ra[]=$d['cn3'];  $ra[]=$d['cn4'];  $ra[]=$d['chinese'];  shuffle($ra);
	$_SESSION['dc_no']=$t_no;  $_SESSION['dc_answer']=$d['chinese'];  $_SESSION['dc_ra']=$ra;  $_SESSION['dc_tishi']=$d['tishi'];
	echo "<tr><td><input type=\"radio\" name=\"choice\" value=\"$ra[0]\"> $ra[0]<br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[1]\"> $ra[1]<br><input type=\"radio\" name=\"choice\" value=\"$ra[2]\"> $ra[2]<br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[3]\"> $ra[3]<br><input type=\"radio\" name=\"choice\" value=\"$ra[4]\"> $ra[4]<br>";
	echo "<br><input type=\"submit\" name=\"\" value=\"提交\"></td></tr></form></table>";  $q->free();  break;
case "单词练习答案":// 正确的单词显示学习提示, 错误的显示对应的英文和中文,提示
	$t_no=$_SESSION['dc_no'];  $answer=$_SESSION['dc_answer'];  $userid=$_SESSION['userid'];  $ra=$_SESSION['dc_ra'];  $s1=$_SESSION['dc_name'];  $tishi=$_SESSION['dc_tishi'];
	if(!isset($_POST['choice'])){ // 空答案
		echo "<table width=\"40%\" align=\"center\"><tr><td>请选择一个正确答案</td></tr><tr><td><br><a href=\"index.php?action=单词练习&t_no=$t_no\">继续</a></td></tr></table>";
	}else{ $sql="SELECT * FROM sat_dctj where danci_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $max_num=$q->num_rows;
		if($answer==$_POST['choice']){ // 答案正确
			if($max_num>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];  $q->free();
				$sql="UPDATE sat_dctj set yes=$yes where no=$no";  $db->query($sql);
			}else{ $q->free();  $sql="INSERT INTO sat_dctj(danci_no,userid,yes,wrong) values('$t_no','$userid','1','0')";  $db->query($sql); }
			$t_no=$t_no+1;  echo "<table width=\"40%\" align=\"center\"><tr><td>答案正确</td></tr>";
			echo "<tr><td><br>$s1</td></tr> <tr><td>$answer</td></tr> <tr><td>提示: $tishi</tr></td>";
			echo "<tr><td><br><a href=\"index.php?action=单词练习&t_no=$t_no\">下一题</a></td>";
			echo "<td><a href=\"index.php?action=Login\">返回主菜单</a></td></tr></table>";
		}else{ // 答案错误
			if($max_num>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];  $q->free();
				$sql="UPDATE sat_dctj set wrong=$wrong where no=$no";  $db->query($sql);
			}else{ $q->free();  $sql="INSERT INTO sat_dctj(danci_no,userid,yes,wrong) values('$t_no','$userid','0','1')";  $db->query($sql); }
			$answer=$_POST['choice'];  $sql="SELECT * from sat_danci where chinese='$answer'";  $q=$db->query($sql);  $d=$q->fetch_array();
			$s1=$d['name']." ".$d['yinbiao'];  $tishi=$d['tishi'];  $answer=$d['chinese'];
			echo "<table width=\"40%\" align=\"center\"><tr><td>答案错误</td></tr>";
			echo "<tr><td><br>$s1</td></tr> <tr><td>$answer</td></tr> <tr><td>提示: $tishi</tr></td>";
			echo "<tr><td><br><a href=\"index.php?action=单词练习&t_no=$t_no\">继续</a></td></tr></table>";
		}
	}
	break;

case "单词填空":  $userid=$_SESSION['userid'];
	if(isset($_REQUEST['t_no'])){ $t_no=intval($_REQUEST['t_no']);	// 题目已定义
		$sql="SELECT * FROM sat_dctj2 where userid='$userid' and danci_no='$t_no'";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong']; }else{ $yes=0;  $err=0; }
	}else{ $sql="SELECT * FROM sat_dctj2 where userid='$userid' order by danci_no desc";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $t_no=intval($d['danci_no']); }else{ $yes=0;  $err=0;  $t_no=1; }
	}
	$q->free();  $q=$db->query("SELECT count(*) FROM sat_danci2");  $d=$q->fetch_array();  $max_num=$d[0];  $q->free();
	if($t_no<1){ $t_no=1; }  if($t_no>$max_num){ $t_no=$max_num; }  $t_1=$t_no+1;  if($t_1>$max_num){ $t_1=$max_num; }
	$t_0=$t_no-1;  if($t_0<1){ $t_0=1; }  $q=$db->query("SELECT * FROM sat_danci2 where no=$t_no");  $d=$q->fetch_array();
	echo "<table width=\"40%\" align=\"center\"><tr><td>$userid 单词填空: $t_no 题目总数=$max_num 对=$yes 错=$err</td></tr><tr><td>";
	echo "<a href=\"index.php?action=单词填空&t_no=$t_0\">上一题</a>&nbsp &nbsp<a href=\"index.php?action=单词填空&t_no=$t_1\">下一题</a>&nbsp &nbsp";
	echo "<a href=\"index.php?action=Login\">返回</a></td></tr><tr><td><br></td></tr><tr><td>$d[timu]</td><tr><tr><td><br>请选择正确答案:</td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\"><input type=\"hidden\" name=\"action\" value=\"单词填空答案\">";
	$ra=array();  $ra[]=$d['choice1'];  $ra[]=$d['choice2'];  $ra[]=$d['choice3'];  $ra[]=$d['choice4'];  $ra[]=$d['choice5'];
	$rb=array();  $rb[]=$d['answer1'];  $rb[]=$d['answer2'];  $rb[]=$d['answer3'];  $rb[]=$d['answer4'];  $rb[]=$d['answer5'];
	$_SESSION['danci2_no']=$t_no;  $_SESSION['danci2_answer']="";
	for($i=0; $i<5; $i++)  if(strtolower($rb[$i])=="ok"){ $_SESSION['danci2_answer']=$ra[$i];  break; }  shuffle($ra);
	echo "<tr><td><input type=\"radio\" name=\"choice\" value=\"$ra[0]\"> $ra[0]<br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[1]\"> $ra[1]<br><input type=\"radio\" name=\"choice\" value=\"$ra[2]\"> $ra[2]<br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[3]\"> $ra[3]<br><input type=\"radio\" name=\"choice\" value=\"$ra[4]\"> $ra[4]<br>";
	echo "<br><input type=\"submit\" name=\"\" value=\"提交\"> </td></tr></form></table>";  break;
case "单词填空答案":  $t_no=$_SESSION['danci2_no'];  $answer=$_SESSION['danci2_answer'];  $userid=$_SESSION['userid'];
	if(!isset($_POST['choice'])){
		echo "<table width=\"40%\" align=\"center\"><tr><td>请选择一个正确答案</td></tr>";
		echo "<tr><td><br><a href=\"index.php?action=单词填空&t_no=$t_no\">继续</a></td></tr></table>";  break;
	}
	$sql="SELECT * FROM sat_dctj2 where danci_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $max_num=$q->num_rows;
	if($answer==$_POST['choice']){	// 正确
		if($max_num>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];
			$sql="UPDATE sat_dctj2 set yes=$yes where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO sat_dctj2(danci_no, userid, yes, wrong) values('$t_no', '$userid', '1', '0')";  $db->query($sql); }  $t_no=$t_no+1;
		echo "<table width=\"40%\" align=\"center\"><tr><td>正确<br></td></tr>";
		echo "<tr><td><a href=\"index.php?action=单词填空&t_no=$t_no\">下一题</a></td>";
		echo "<td><a href=\"index.php?action=Login\">返回主菜单</a></td></tr></table>";
	}else{	// 错误
		if($max_num>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];
			$sql="UPDATE sat_dctj2 set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO sat_dctj2(danci_no, userid, yes, wrong) values('$t_no', '$userid', '0', '1')";  $db->query($sql); }
		echo "<table width=\"40%\" align=\"center\"><tr><td>错误<br></td></tr>";
		echo "<tr><td><a href=\"index.php?action=单词填空&t_no=$t_no\">继续</a></td></tr></table>";
	}
	break;

case "语法测验":  $userid=$_SESSION['userid'];	// 只选择一个正确答案
	if(isset($_REQUEST['t_no'])){ $t_no=intval($_REQUEST['t_no']);	// 题目已定义
		$sql="SELECT * FROM sat_yfcytj where userid='$userid' and yufa_no='$t_no'";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong']; }else{ $yes=0;  $err=0; }
	}else{ $sql="SELECT * FROM sat_yfcytj where userid='$userid' order by yufa_no desc";  $q=$db->query($sql);
		if($d=$q->fetch_array()){ $yes=$d['yes'];  $err=$d['wrong'];  $t_no=intval($d['yufa_no']); }else{ $yes=0;  $err=0;  $t_no=1; }
	}
	$q->free();  $q=$db->query("SELECT count(*) FROM sat_yufa");  $d=$q->fetch_array();  $max_num=$d[0];  $q->free();  if($t_no<1){ $t_no=1; }
	if($t_no>$max_num){ $t_no=$max_num; }  $t_1=$t_no+1;  if($t_1>$max_num){ $t_1=$max_num; }  $t_0=$t_no-1;  if($t_0<1){ $t_0=1; }
	$q=$db->query("SELECT * FROM sat_yufa where no=$t_no");  $d=$q->fetch_array();  $timu=$d['timu'];
	echo "<table width=\"50%\" align=\"center\"><tr><td>$userid 语法测验: $t_no 题目总数=$max_num 对=$yes 错=$err</td></tr><tr><td>";
	echo "<a href=\"index.php?action=语法测验&t_no=$t_0\">上一题</a>&nbsp &nbsp<a href=\"index.php?action=语法测验&t_no=$t_1\">下一题</a>&nbsp &nbsp";
	echo "<a href=\"index.php?action=Login\">返回</a></td></tr><tr><td><br></td></tr><tr><td>$timu</td><tr><tr><td><br>请选择正确答案:</td></tr>";
	echo "<form action=\"index.php\" method=\"post\" onsubmit=\"return check()\">	<input type=\"hidden\" name=\"action\" value=\"语法测验答案\">";
	$ra=array();  $ra[]=$d['choice1'];  $ra[]=$d['choice2'];  $ra[]=$d['choice3'];  $ra[]=$d['choice4'];  $ra[]=$d['choice5'];
	$rb=array();  $rb[]=$d['answer1'];  $rb[]=$d['answer2'];  $rb[]=$d['answer3'];  $rb[]=$d['answer4'];  $rb[]=$d['answer5'];
	$_SESSION['yfcy_no']=$t_no;  $_SESSION['yfcy_answer']="";
	for($i=0; $i<5; $i++)  if($rb[$i]=="ok"){ $_SESSION['yfcy_answer']=$ra[$i];  break; }  //shuffle($ra);
	echo "<tr><td><input type=\"radio\" name=\"choice\" value=\"$ra[0]\"> $ra[0]<br><br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[1]\"> $ra[1]<br><br><input type=\"radio\" name=\"choice\" value=\"$ra[2]\"> $ra[2]<br><br>";
	echo "<input type=\"radio\" name=\"choice\" value=\"$ra[3]\"> $ra[3]<br><br><input type=\"radio\" name=\"choice\" value=\"$ra[4]\"> $ra[4]<br>";
	echo "<br><input type=\"submit\" name=\"\" value=\"提交\"></td></tr></form></table>";  break;
case "语法测验答案":  $userid=$_SESSION['userid'];  $t_no=$_SESSION['yfcy_no'];  $answer=$_SESSION['yfcy_answer'];
	if(!isset($_POST['choice'])){ echo "<table width=\"40%\" align=\"center\"><tr><td>请选择一个正确答案</td></tr>";
		echo "<tr><td><br><a href=\"index.php?action=语法测验&t_no=$t_no\">继续</a></td></tr></table>";  break; }
	$sql="SELECT * FROM sat_yfcytj where yufa_no='$t_no' and userid='$userid'";  $q=$db->query($sql);  $max_num=$q->num_rows;
	if($answer==$_POST['choice']){	// 正确
		if($max_num>0){ $d=$q->fetch_array();  $yes=$d['yes']+1;  $no=$d['no'];
			$sql="UPDATE sat_yfcytj set yes=$yes where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO sat_yfcytj(yufa_no, userid, yes, wrong) values('$t_no', '$userid', '1', '0')";  $db->query($sql); }  $t_no=$t_no+1;
		echo "<table width=\"40%\" align=\"center\"><tr><td>正确<br></td></tr><tr><td><a href=\"index.php?action=语法测验&t_no=$t_no\">下一题</a></td>";
		echo "<td><a href=\"index.php?action=Login\">返回主菜单</a></td></tr></table>";
	}else{	// 错误
		if($max_num>0){ $d=$q->fetch_array();  $wrong=$d['wrong']+1;  $no=$d['no'];
			$sql="UPDATE sat_yfcytj set wrong=$wrong where no=$no";  $db->query($sql);
		}else{ $sql="INSERT INTO sat_yfcytj(yufa_no, userid, yes, wrong) values('$t_no', '$userid', '0', '1')";  $db->query($sql); }
		echo "<table width=\"40%\" align=\"center\"><tr><td>错误<br></td></tr>";
		echo "<tr><td><a href=\"index.php?action=语法测验&t_no=$t_no\">继续</a></td></tr></table>";
	}  break;

case "logon":  session_destroy();  Login_Form();  break;	// 输入Username & Password
case "Login":// 判断用户名
	if(isset($_SESSION['usermode'])){ Main_Menu(); }
	else{ $i_userid=$_REQUEST['i_username'];  $i_pass=$_REQUEST['i_password'];  $sql="SELECT * FROM sat_user WHERE userid='$i_userid' and password='$i_pass'";
		$q=$db->query($sql);  $d=$q->fetch_array();  $q->free();
		if($d){ $_SESSION['userid']=$i_userid;  $_SESSION['usermode']=$d['usermode'];  Main_Menu();
		}else{ Login_Form(); }
	}  break;
case "Quit":	session_destroy();  Login_Form();  break;
case "Main_Menu":  Main_Menu();  break;
case "使用帮助":   Main_Menu();  break;
case "单词视频":  echo "<table width=\"20%\" align=\"left\"><tr class=\"tbhead\"><td>SAT单词学习视频</td><td><a href=\"index.php?action=Login\">返回</a></td></tr>";
	$q=$db->query("SELECT * FROM sat_movie");  while($d=$q->fetch_array()){ echo "<tr><td><a href='index.php?action=视频播放&moviename=$d[path]'>$d[path]</a></td></tr>"; }
	echo "</table>";  $q->free();  break;
case "视频播放":  echo "<table width=\"20%\" align=\"left\"><tr class=\"tbhead\"><td>SAT单词学习视频</td><td><a href=\"index.php?action=Login\">返回</a></td></tr>";
	$q=$db->query("SELECT * FROM sat_movie");  while($d=$q->fetch_array()){ echo "<tr><td><a href='index.php?action=视频播放&moviename=$d[path]'>$d[path]</a></td></tr>"; }
	echo "</table>";  $q->free();  $moviename=$_GET['moviename'];//112.124.114.194
	echo "<video id=\"video1\" src=\"http://112.124.114.194/mp4/$moviename\" autoplay=\"true\" controls=\"controls\" width=\"640\" height=\"480\"></video>";  break;
case "语法视频":  echo "<table width=\"20%\" align=\"left\"><tr class=\"tbhead\"><td>SAT语法学习视频</td><td><a href=\"index.php?action=Login\">返回</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IE工具串讲.mp4'>IE工具串讲</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IS第一圈细致串讲.mp4'>IS第一圈细致串讲</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IS第二圈细致串讲.mp4'>IS第二圈细致串讲</a></td></tr>";
	echo "</table>";  break;
case "语法播放":  echo "<table width=\"20%\" align=\"left\"><tr class=\"tbhead\"><td>SAT语法学习视频</td><td><a href=\"index.php?action=Login\">返回</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IE工具串讲.mp4'>IE工具串讲</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IS第一圈细致串讲.mp4'>IS第一圈细致串讲</a></td></tr>";
	echo "<tr><td><a href='index.php?action=语法播放&moviename=IS第二圈细致串讲.mp4'>IS第二圈细致串讲</a></td></tr>";
	echo "</table>";  $moviename=$_GET['moviename'];
	echo "<video id=\"video1\" src=\"http://112.124.114.194/mp4/$moviename\" autoplay=\"true\" controls=\"controls\" width=\"640\" height=\"480\"></video>";  break;
//case "语法视频":  echo "<table width=\"20%\" align=\"left\"><tr class=\"tbhead\"><td>SAT语法学习视频</td><td><a href=\"index.php?action=Login\">返回</a></td></tr></table>";
//	echo "<video id=\"video1\" src=\"http://112.124.114.194/mp4/语法教学视频.mp4\" autoplay=\"true\" controls=\"controls\" width=\"640\" height=\"480\"></video>";  break;
default: session_destroy();  Login_Form();  break;
}  $db->close();  echo "</body></html>";  ?>
