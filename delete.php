<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$operator=$_POST["operator"];
$rid=$_POST["rid"];
$category=$_POST["category"];
$specification=$_POST["specification"];
$today=date("Y-m-d H:i");
//echo "console.log("14")";
$conn_del = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
$sql = "DELETE FROM 设备使用状态 WHERE ID='$rid'";
$res = $conn_del->query($sql);
if($res){
    echo "行已删除";
    $sql_unusual="INSERT INTO 异常操作记录(操作人,修改时间,设备ID,设备类别,品牌规格,已读) VALUES ('$operator','$today','$rid','$category','$specification',0)";
    $res_unusual=$conn_del->query($sql_unusual);
    if(!$res_unusual)
        {
            echo "录入异常操作记录失败";
        }
}
else{
    echo "删除失败";
}
$conn_del->close();
?>