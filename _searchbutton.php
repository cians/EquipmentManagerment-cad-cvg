<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$category=$_POST["category"];
$status=$_POST["status"];
$registration=$_POST["registration"];
$conn_que = new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
if($pname=="所有姓名")
{
    if($status=="在用")
        if($category=="所有种类")
            if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 入库类别='$registration'";
        else
        {
             if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 设备类别 like '%$category%'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 设备类别 like '%$category%' AND 入库类别='$registration'";
        }
    else if($status=="空闲")
    {
         if($category=="所有种类")
            if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 入库类别='$registration'";
        else
        {
             if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 设备类别 like '%$category%'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 设备类别 like '%$category%' AND 入库类别='$registration'";
        }
    }
    else
    {
        if($category=="所有种类")
            if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 入库类别='$registration'";
        else
        {
             if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 设备类别 like '%$category%'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 设备类别 like '%$category%' AND 入库类别='$registration'";
        }
    }
}
else 
{
    if($category=="所有种类")
            if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 入库类别='$registration'";
   else
    {
            if($registration=="所有类别")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 设备类别 like '%$category%'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 设备类别 like '%$category%' AND 入库类别='$registration'";
    }
    //当pname被赋值后，status即为在用。
}
//echo $sql_que;
$res=$conn_que->query($sql_que);
//$res_js=json_encode($res);
if(!$res)
{
    echo 1;//查询出错
}
else
{
    $datas=$res->fetch_all();//
    $datas_js=json_encode($datas,JSON_UNESCAPED_UNICODE);//参数调整了中文乱码
    echo $datas_js;
}
$conn_que->close();
?>