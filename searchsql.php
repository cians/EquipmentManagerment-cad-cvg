<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
$pname=$_POST["pname"];
$category=$_POST["category"];
$status=$_POST["status"];
$registration=$_POST["registration"];
$conn_que = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
if($pname=="所有姓名")
{
    if($status=="在用")
        if($category=="所有类型")
            if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 是否入库='$registration'";
        else
        {
             if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 设备类型='$category'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人<>'空闲' AND 设备类型='$category' AND 是否入库='$registration'";
        }
    else if($status=="空闲")
    {
         if($category=="所有类型")
            if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 是否入库='$registration'";
        else
        {
             if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 设备类型='$category'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='空闲' AND 设备类型='$category' AND 是否入库='$registration'";
        }
    }
    else
    {
        if($category=="所有类型")
            if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 是否入库='$registration'";
        else
        {
             if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 设备类型='$category'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 设备类型='$category' AND 是否入库='$registration'";
        }
    }
}
else 
{
    if($category=="所有类型")
            if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 是否入库='$registration'";
   else
    {
            if($registration=="所有")
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 设备类型='$category'";
            else
                 $sql_que="SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' AND 设备类型='$category' AND 是否入库='$registration'";
    }
    //当pname被赋值后，status即为在用。
}
$res=$conn_que->query($sql_que);
if(!$res)
{
    echo 1;//查询出错
}
else
{
    echo $res;
}
?>