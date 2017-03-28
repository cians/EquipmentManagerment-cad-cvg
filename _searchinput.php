<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");
$inputext=$_POST["inputext"];
$conn_que = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
$sql_oo="select * from 设备使用状态 where ID like '%$inputext%'
union
select * from 设备使用状态 where 设备类别 like '%$inputext%'
union 
select * from 设备使用状态 where 品牌规格 like '%$inputext%'
union 
select * from 设备使用状态 where 当前使用人 like '%$inputext%'
union 
select * from 设备使用状态 where 备注 like '%$inputext%'";
// $sql_oo="select * from 设备使用状态 where 当前使用人 like '%$inputext%'";
$res_oo=$conn_que->query($sql_oo);
if(!$res_oo)
    echo 1;
else
{
    $datas=$res_oo->fetch_all();
    $datas_js=json_encode($datas,JSON_UNESCAPED_UNICODE);//参数调整了中文乱码
    echo $datas_js;
}

$conn_que->close();
?>