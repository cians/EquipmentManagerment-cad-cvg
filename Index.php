<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="./Login_files/login1.css">
    <title>设备管理系统--登录</title>
    <script charset="utf-8" src="./Login_files/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="utf-8">
        function confirm()
        {
            var uname=$("#id_username").val();
            var pword=$("#id_password").val();
            if(!pword)
            {
                pword='<?php echo $_SERVER[ "REMOTE_ADDR"]; ?>';
            }
            console.log(uname+pword);
            $.post("confirm.php",{username:uname,password:pword},function(pdata)
            {
                data=parseInt(pdata);
                switch (data)
                {
                    case 0:
                        var qr=confirm("你的登录密码已设置为你的IP:"+pword+"，下次登录IP没变的话可无密码登录");
                              if(qr==true) {window.location.href='main.php';}
                        console.log("password has set as your ip");
                        break;
                    case 1:
                        window.location.href='main.php';
                        break;
                    case 8:
                        alert("errors! try typing your ip");
                        break;
                    case 9:
                        alert("error occurs when set password");
                        break;
                    case 7:
                        alert("录入登录时间出错");
                        break;
                    default:
                        alert("登录出错，请检查姓名和密码，或联系管理员");
                }
            })
        }
   		    $(function()
               {
                    document.onkeydown=function(event)
                    {
                        var e = event || window.event || arguments.callee.caller.arguments[0];
                          if(e && e.keyCode==13)
                          { // enter 键
                            confirm();
                          }

                    }


                   $("#loginB").click(function()
                   {
                       confirm();
                   })

               })
    </script>


</head>
<body>
      <div class="frontHome page" id="loginbox">
        <div class="wrap-container">
            <div id="home_container" class="clearfix">
                <div id="home_main">
                    <div class="inner-main">
                        <div class="login_box">
                            <div class="form-title">
                                <h3>CVG设备管理系统</h3>
                                <h4>LOGIN</h4>
                            </div>
                            <form class="well form-horizontal"  style="background:#FFF">
                                <div class="logininput"> <input type="hidden" name="csrfmiddlewaretoken" value="WkQ4n9vcbtWn9zE7RUBTaNu2luEW4gE9">
                                    <fieldset>
                                        <div id="div_id_username" class="clearfix control-group">
                                            <label for="id_username" class="control-label requiredField">
                                                帐号<span class="asteriskField">*</span>
                                            </label>
                                            <div class="controls">
                                                <input class="textinput textInput" id="id_username" maxlength="30" name="username" placeholder="姓名" type="text">
                                            </div>
                                        </div>
                                        <div id="div_id_password" class="clearfix control-group">
                                            <label for="id_password" class="control-label requiredField">
                                                  密码<span class="asteriskField">*</span>
                                             </label>
                                            <div class="controls">
                                                <input class="textinput textInput" id="id_password" name="password" placeholder=<?php echo $_SERVER[ "REMOTE_ADDR"]; ?> type="password">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <fieldset class="form-actions" style="position:relative; margin-top:15px;">
                                    <div class="loginFormBtn clearfix">
                                        <button id=loginB class="login_btn js_login_btn" type="button" style="width:100%;">登录</button>
                                        <!--  <a href="" target="_black" class="register_btn" type="button" style="width:100%;">注册</a> -->
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-footer">
            <div id="footer">
                <div class="inner-footer">
                    <div class="foot">
                        <div class="foot_kh">
                            <a class="foot_kh" href="http://www.zjucvg.net/">Computer Vision Group @ State Key Lab of CAD&CG, Zhejiang University</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>