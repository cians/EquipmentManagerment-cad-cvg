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
$operator=$_POST['operator'];
$today=date("Y-m-d H:i");
//echo "console.log("14")";
$conn_edit = new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
//$sql = "UPDATE 设备使用状态 SET 设备类别='$category', 品牌规格='$specification', 当前使用人='$pname', 修改时间='$time' WHERE ID='$rid'";
$sql = "UPDATE 设备使用状态 SET 设备类别='$category', 品牌规格='$specification', 当前使用人='$pname',备注= '$detail', 修改时间='$today' WHERE ID='$rid'";
$res = $conn_edit->query($sql);
if($res){
    echo $pname;
    if($operator!=$pname && !ctype_space($category)&& !ctype_space($specification))
    {

        $sql_unusual="INSERT INTO 异常操作记录 VALUES ('$operator','$today','$pname','$rid','$category','$specification',0,'修改')";
        $sql_log="UPDATE 设备使用状态 SET 使用日志=concat(使用日志,'。$time:$pname.开始使用') WHERE ID='$rid'";
        $res_unusual=$conn_edit->query($sql_unusual);
        $res_log=$conn_edit->query($sql_log);
        if(!$res_unusual && !$res_log)
        {
            echo "录入异常操作记录失败";
        }
    }

}
else{
    echo "修改失败";
}

$conn_edit->close();
?>