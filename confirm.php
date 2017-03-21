  <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php 
    ini_set('display_errors','on');
    error_reporting(E_ALL);
     if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    $uname=$_SESSION['username']=$_POST['username'];
    $uword=$_SESSION['password']=$_POST['password'];
    $conn_confirm = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
    $sql_confirm="SELECT 登录密码 FROM 人员 WHERE 姓名='$uname'";
   if($res=$conn_confirm->query($sql_confirm)){
           while($row = $res->fetch_assoc())
            {
                    $pwd=$row["登录密码"];

            }
   }
    if(is_null($pwd))
    {
        $pwd=$_SERVER["REMOTE_ADDR"];
        //echo $uword;
        $sql_update="UPDATE 人员 SET 登录密码='$pwd' WHERE 姓名='$uname'";
        $ress=$conn_confirm->query($sql_update);
        if($ress){
            echo "password has set as your ip";
        }
        else{
            echo "设置密码失败";
        }
      $conn_confirm->close();
    }
    elseif($pwd == $uword)
    {
        echo "通过";
        $conn_confirm->close();
    }
    else
    {
        echo "error";
        $conn_confirm->close();
    }

    ?>
    </html>