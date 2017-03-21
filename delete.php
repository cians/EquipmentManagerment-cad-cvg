<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$rid=$_POST["rid"];
$today=date("Y-m-d H:i");
//echo "console.log("14")";
$conn_del = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
$sql = "DELETE FROM 设备使用状态 WHERE ID='$rid'";
$res = $conn_del->query($sql);
if($res){
    echo "行已删除";
}
else{
    echo "删除失败";
}
$conn_del->close();
?>