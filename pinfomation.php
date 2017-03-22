<link href="./login_files/buttons.css" rel="stylesheet" type="text/css">
<link href="./login_files/personinfo.css" rel="stylesheet" type="text/css">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
  ?>
    <head>
    <script src="./login_files/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
    $(function()
    {
        
    })


    </script>
    </head>
<form >
    <table id=table border="1" cellspacing="0" cellpadding="5" rules="row">
        <tr>
            <td>姓名：</td>
            <td id=pname><?php echo $_SESSION['username']; ?></td>
        </tr>
        <tr>
            <td>学号：</td>
            <td id=Sid></td>
        </tr>
        <tr>
            <td>联系方式：</td>
            <td id=phone></td>
        </tr>
        <tr>
            <td>年级：</td>
            <td id=grade></td>
        </tr>
        <tr>
            <td>上次登录时间：</td>
            <td id=logindate></td>
        </tr>
        <tr>
           <td>输入新密码：</td>
            <td id=newpword>
                <input id=newpword >
            </td>
        </tr>
        <tr>
            <td>确认新密码：</td>
            <td id=newpword>
                <input id=newpword >
            </td>
        </tr>
        <tr>
            <td colspan=2 align=center>提交修改</td>
        </tr>
        </table>
    </form>
</html>