<?php
$yourname=$_POST['yourname'];
$conn_read = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
$sql_unread="UPDATE 异常操作记录 SET 已读=1 WHERE 被修改人='$yourname'";
$res_unread=$conn_read->query($sql_unread);
if($res_unread)
{
    echo errors;
}
?>