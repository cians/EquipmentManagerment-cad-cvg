<!DOCTYPE HTML>
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="./css/personinfo.css" rel="stylesheet" type="text/css">
<html lang="zh-cn" xml:lang="zh-cn">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
 <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
  ?>
    <head>
    <script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
     function td2textbox(tdObj)
        {
                        //找到当前鼠标单击的td  
            var oldText = tdObj.html();
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
                            tdObj.html(inputObj.val());
                            //获取一行的所有列
                            //save2server();
                            break;
                        case 27:
                            tdObj.html(oldText);
                            break;
                    }
                }).blur(function()
                {
                            //bug 在IP地址访问时，没有执行,没有审查元素--因为与input.blur冲突了 = = 
                            var newText = inputObj.val();  
                            tdObj.html(newText);
                            //save2server();

                });
        }

    $(function()
    {
	 function save2server()
        {
            //var tds=tdObj.parent("tr").children("td");
            var tname=$("#pname").html(); //！！！id是数字要验证是否有影响
            var tsid=$("#sid").html();
            var tgrade=$("#grade").html();
            var tphone=$("#phone").html();
            var tpword=$.trim($(".newpwords").val());
            var tpword2=$.trim($(".newpwords2").val());
            <?php
					if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
					echo "var yourname='{$_SESSION['username']}';";
			?>
            console.log(tpword);
            if(tpword==tpword2&&tname==yourname)
            $.ajax({
				url:"_editpinfo.php",
				type:"POST",
				timeout:300000,
				caceh:false,
				async:false,
				data:{pname:tname,sid:tsid,grade:tgrade,phone:tphone,pword:tpword},
				success:function(data)
                {
                //有时没有返回data，可能需要延时----采用axaj同步解决
                var datai=parseInt(data);
                console.log(datai);
                    if(datai==0)
                    {
                        alert("修改出错");
                    }
                    else
                        alert("信息已修改");
                },
				error:function()
				{
					alert("errors");
				}
			})
            else
                alert("两次输入的密码不一致!");
        }
        $("#sid,#grade,#phone").click(function()
        {
            td2textbox($(this));
        })
        $("#submit").click(function()
        {
            save2server();   
        location.reload();			
        })
    })


    </script>
    </head>
<body>
    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    $pname=$_SESSION['username'];
    $conn_p = new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
    $sql_q="SELECT * FROM 人员 WHERE 姓名='$pname'";
    $res=$conn_p->query($sql_q);
    if($row=$res->fetch_assoc())
    {
    ?>
<form>
    <table class=tablep border="1" cellspacing="0" cellpadding="5">
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
            <td class=newpword>
                <input class=newpwords name="password" type="password">
            </td>
        </tr>
        <tr>
            <td>确认新密码：</td>
            <td class=newpword>
                <input class=newpwords2  name="password" type="password">
            </td>
            <lable id=tips></lable>
        </tr>
        <tr>
            <td id=submit colspan=2 align=center>
                <input class="btn" type="submit" value="提交修改"></td>
        </tr>
        </table>
    </form>
    <?php
    }
    ?>
    </body>
</html>