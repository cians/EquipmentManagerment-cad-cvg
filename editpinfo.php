<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$sid=$_POST["sid"];
$grade=$_POST["grade"];
$phone=$_POST["phone"];
$pword=$_POST["pword"];
//$today=date("Y-m-d H:i");
$conn_editp = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
if(!ctype_space($pword)&&!empty($pword))
    {$sqlp = "UPDATE 人员 SET 学号='$sid', 年级='$grade', 联系方式='$phone',登录密码='$pword' WHERE 姓名='$pname'";}
else
    {$sqlp = "UPDATE 人员 SET 学号='$sid', 年级='$grade', 联系方式='$phone' WHERE 姓名='$pname'";}
$res=$conn_editp->query($sqlp);
if(!$res)
{
    echo 0;
}
else
    {echo 1;}
$conn_editp->close();
?>