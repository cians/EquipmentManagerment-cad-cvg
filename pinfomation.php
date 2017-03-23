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
        function td2textbox(tdObj)
        {
                        //找到当前鼠标单击的td  
            var oldText = tdObj.text();
            var inputObj = $("<input type='text' />");  
            //去掉文本框的边框  
            inputObj.css("border-width", 0);   
            //使文本框的宽度和td的宽度相同  
            inputObj.width(tdObj.width());  
            inputObj.height(tdObj.height());  
            //去掉文本框的外边距  
            inputObj.css("margin", 0);  
            inputObj.css("padding", 0);  
            inputObj.css("border", 0); 
            inputObj.css("font-size", tdObj.css("font-size"));  
            inputObj.css("background-color", tdObj.css("background-color"));  
            //创建一个文本框 设置事件属性等 
            inputObj.val(oldText);  
            // //把文本框放到td中  
            tdObj.html(inputObj); 
            inputObj.click(function () 
                {  
                    return false;  
                }); 
            //文本框失去焦点的时候变为文本  
            // inputObj.blur(function ()
            // 		{   
            // 			var newText = $(this).val();  
            // 			tdObj.html(newText);  
            // 			console.log(newText);        
            // 		}); 
            inputObj.trigger("focus").trigger("select");
            inputObj.keydown(function(event)
                {
                    switch(event.keyCode)
                    {
                        case 13://回车
                            tdObj.html($(this).val());
                            //获取一行的所有列
                            execute(tdObj);
                            break;
                        case 27:
                            tdObj.html(oldText);
                            break;
                    }
                }).blur(function()
                {
                            //bug 在IP地址访问时，没有执行,没有审查元素--因为与input.blur冲突了 = = 
                            var newText = $(this).val();  
                            tdObj.html(newText);
                            execute(tdObj);

                });
        }
        function execute()
        {
            //var tds=tdObj.parent("tr").children("td");
            var tname=$("#pname").text(); //！！！id是数字要验证是否有影响
            var tsid=$("#sid").text();
            var tgrade=$("#grade").text();
            var tphone=$("#phone").text();
            var tpword=$("#newpwords").value;
            var tpword2=$("#newpwords2").value;
            <?php
					if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
					echo "var yourname='{$_SESSION['username']}';";
			?>
            console.log(tpword);
            $.post("editpinfo.php",{pname:tname,sid:tsid,grade:tgrade,phone:tphone,pword:tpword,operator:yourname},function(data)
				{
                   var datai=parseInt(data);
                    if(datai==0)
                    {
                        alert("修改出错");
                    }
                })
        }
        $("#pname,#sid,#grade,#phone").click(function()
        {
            td2textbox($(this));
        })
    })


    </script>
    </head>
<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    $pname=$_SESSION['username'];
    $conn_p = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
    $sql_q="SELECT * FROM 人员 WHERE 姓名='$pname'";
    $res=$conn_p->query($sql_q);
    if($row=$res->fetch_assoc())
    {
    ?>
<form method=POST action=submit.php>
    <table id=table border="1" cellspacing="0" cellpadding="5" rules="row">
        <tr>
            <td>姓名：</td>
            <td id=pname><?= $pname ?></td>
        </tr>
        <tr>
            <td>学号：</td>
            <td id=sid><?= $row['学号'] ?></td>
        </tr>
        <tr>
            <td>年级：</td>
            <td id=grade><?= $row['年级'] ?></td>
        </tr>
        <tr>
           <td>联系方式：</td>
            <td id=phone><?= $row['联系方式'] ?></td>
        </tr>
        <tr>
            <td>上次登录时间：</td>
            <td id=logindate><?= $row['上次登录时间'] ?></td>
        </tr>
        <tr>
           <td>输入新密码：</td>
            <td id=newpword>
                <input id=newpwords name="password" type="password">
            </td>
        </tr>
        <tr>
            <td>确认新密码：</td>
            <td id=newpword>
                <input id=newpwords2  name="password" type="password">
            </td>
            <lable id=tips></lable>
        </tr>
        <tr>
            <td id=submit colspan=2 align=center>
                <input type="submit" value="提交修改"></td>
        </tr>
        </table>
    </form>
    <?php
    }
    ?>
    </body>
</html>