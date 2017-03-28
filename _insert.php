<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$rid=$_POST["id"];
$pname=$_POST["pname"];
$category=$_POST["category"];
$specification=$_POST["specification"];
$detail=$_POST["detail"];
$time=$_POST["time"];
$today=date("Ymd");
//echo "console.log("14")";
$conn_insert = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
//$sql_count="";
$sql ="INSERT INTO 设备使用状态 (当前使用人,设备类别,品牌规格,使用日志,备注,修改时间) VALUES ('$pname','$category','$specification','$time:$pname.开始使用','$detail','$time')";
$res = $conn_insert->query($sql);
if($res){
    echo $pname;
}
else{
    echo "修改失败";
}
$conn_insert->close();
?>