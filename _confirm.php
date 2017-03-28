    <?php 
    ini_set('display_errors','on');
    error_reporting(E_ALL);
     if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    $uname=$_SESSION['username']=$_POST['username'];
    $uword=$_SESSION['password']=$_POST['password'];
    $today=date("Y-m-d H:i");
    $conn_confirm = new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
    $sql_confirm="SELECT 登录密码 FROM 人员 WHERE 姓名='$uname'";
   if($res=$conn_confirm->query($sql_confirm))
   {
           while($row = $res->fetch_assoc())
            {
                    $pwd=$row["登录密码"];
                  //  echo $pwd;
            }

    if(is_null($pwd))
    {
        $pwd=$_SERVER["REMOTE_ADDR"];
        //echo $uword;
        $sql_update="UPDATE 人员 SET 登录密码='$pwd' WHERE 姓名='$uname'";
        $ress=$conn_confirm->query($sql_update);
        if($ress)
        {
            echo 0;//"password has set as your ip"
            $sql_update_login="UPDATE 人员 SET 上次登录时间='$today' WHERE 姓名='$uname'";
            $res_login=$conn_confirm->query($sql_update_login);
            if(!$res_login)
            {
                echo 7;//录入登录时间出错
            }
        }
        else
        {
            echo 9;//设置密码失败
        }
      $conn_confirm->close();
    }
    elseif($pwd == $uword)
    {
        echo 1;//通过
        $sql_update_login="UPDATE 人员 SET 上次登录时间='$today' WHERE 姓名='$uname'";
        $res_login=$conn_confirm->query($sql_update_login);
        if(!$res_login)
        {
            echo 7;//录入登录时间出错
        }
        $conn_confirm->close();
    }
    else
    {
        echo 8;//登录出错
        $conn_confirm->close();
    }
}
?>