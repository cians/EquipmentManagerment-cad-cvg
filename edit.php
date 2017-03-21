<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$rid=$_POST["id"];
$category=$_POST["category"];
$specification=$_POST["specification"];
$detail=$_POST["detail"];
$time=$_POST["time"];
$today=date("Y-m-d H:i");
//echo "console.log("14")";
$conn_edit = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
//$sql = "UPDATE 设备使用状态 SET 设备类别='$category', 品牌规格='$specification', 使用人='$pname', 修改时间='$time' WHERE ID='$rid'";
$sql = "UPDATE 设备使用状态 SET 设备类别='$category', 品牌规格='$specification', 使用人='$pname',备注= '$detail', 修改时间='$today' WHERE ID='$rid'";
$res = $conn_edit->query($sql);
if($res){
    echo $pname;
}
else{
    echo "修改失败";
}
$conn_edit->close();
?>