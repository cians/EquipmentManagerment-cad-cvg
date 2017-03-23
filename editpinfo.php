<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$sid=$_POST["sid"];
$grade=$_POST["grade"];
$phone=$_POST["phone"];
$pword=$_POST["pword"];
$operator=$_POST['operator'];
$today=date("Y-m-d H:i");
$conn_edit = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
$sql = "UPDATE 人员 SET 姓名='$pname', 学号='$sid', 年级='$grade', 联系方式='$phone' WHERE 姓名='$operator'";
$res=$conn_edit->query($sql);
if(!$res)
{
    echo 0;
}
?>