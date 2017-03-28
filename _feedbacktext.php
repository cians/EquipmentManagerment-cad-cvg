<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
header("charset=utf-8");  
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
$str=$_POST["str"];
$pname=$_SESSION["username"];
$today=date("Y-m-d H:i");
$conn_feed= new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
$sql="insert into 反馈 values('$pname','$str','$today')";
$res=$conn_feed->query($sql);
if(!res)
echo 1;
$conn_feed->close();
?>