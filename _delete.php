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
$sql = "UPDATE 设备使用状态 SET 当前使用人='空闲' WHERE ID='$rid'";
$res = $conn_del->query($sql);
if($res){
    if(!ctype_space($category)||!ctype_space($specification))
    {//如果有设备信息则置空闲，录入敏感操作记录
        echo "行已删除";
        $sql_unusual="INSERT INTO 异常操作记录(操作人,修改时间,设备ID,设备类别,品牌规格,已读,备注) VALUES ('$operator','$today','$rid','$category','$specification',0,'删除')";
        $res_unusual=$conn_del->query($sql_unusual);
        if(!$res_unusual)
        {
            echo "录入异常操作记录失败";
        }
    }
    else
    {//没什么设备信息才删掉这一行
        $sql_remove="DELETE FROM 设备使用状态 WHERE ID='$rid'";
        $res_remove= $conn_del->query($sql_remove);
        if(!$res_remove)
            echo "删除失败";
    }
}
else{
    echo "删除失败";
}
$conn_del->close();
?>