﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<link href="./login_files/FirstP.css" rel="stylesheet" type="text/css">
<link href="./login_files/buttons.css" rel="stylesheet" type="text/css">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <head>
		<script src="./login_files/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		<script src="./login_files/jquery.jeditable.js"  type="text/javascript"></script>
		<script src="./login_files/jquery.jeditable.time.js" type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
		//JS函数在html中是通过相应的事件触发的
		function DelRow(ID)
		{
			<?php
				if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
				echo "var yourname='{$_SESSION['username']}';";
			?>
			$.post("delete.php",{rid:ID,pname:yourname},function(status)
			{
				if(status=="删除失败")
					alert(status);
			});
			setTimeout(function()
			{
				location.reload(true);
			},100);
		};
		function SendRow(TdObj)
		{
			//列添加或变换顺序，此处会受影响
				var tds=TdObj.parent("tr").children("td");//注意：当列表添加列时，此处要随之添列
				var tid=tds.eq(0).text(); //！！！id是数字要验证是否有影响
				var tpname=tds.eq(1).text();
				var tcategory=tds.eq(2).text();
				var tspecification=tds.eq(3).text();
				var tdetail=tds.eq(4).text();
				var ttime=tds.eq(5).text();

				<?php
					if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
					echo "var yourname='{$_SESSION['username']}';";
					?>
				//console.log(tpname);
				$.post("edit.php",{id:tid,pname:tpname,category:tcategory,specification:tspecification,detail:tdetail,time:ttime},function(pname)
				{
					if((pname!=yourname) && (pname!="修改失败"))
						alert("你正在更改"+pname+"的使用记录，系统将把本次操作记录发送给"+pname);
						else if(pname=="修改失败")
							alert(pname);
				});
		// location.reload(true) 没用 其实不需要刷新
		//location.href=location.href;
		};
		function InsertRow(tds)
		{
			//列添加或变换顺序，此处会受影响
			var tid=tds.eq(0).text(); //id是数字要验证是否有影响--无，可用parsInt转换
			var tpname=tds.eq(1).text();
			var tcategory=tds.eq(2).text();
			var tspecification=tds.eq(3).text();
			var tdetail=tds.eq(4).text();
			var ttime=tds.eq(5).text();
			$.post("insert.php",{id:tid,pname:tpname,category:tcategory,specification:tspecification,detail:tdetail,time:ttime},function(pname)
					{
						 if(pname=="修改失败")
								alert(pname);
					});
		//bug 有一次空白记录在数据库没刷出来----因为需要延迟= =
		// location.href=location.href;
			setTimeout(function()
			{
				location.reload(true);
			},100);
		};
		//jquery方法
		$(function(){

			$("tr:odd").css("background-color","#CCCCCC");//偶数行变色
			$("#ptable").css("border","none");//去除边框
			$(".DelButt").click(function()  // 删除按钮
			{
				var RowID=$(this).parent("tr").children("td").eq(0).text();
				var r=confirm("你确定要删除"+RowID+"这一行吗？");
				 if (r==true)
					{
					DelRow(RowID);
					}
			})
			$("#ADD").click(function()
				{
					//添加一行
				<?php
					if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
					echo "var yourname='{$_SESSION['username']}';";
					$dates=date("Y-m-d H:i");
					echo "var now='$dates';";
				?>
					//var len=parseInt($("#ptable tr:last td").eq(0).text())+1; 为了避免编号重复，访问数据库时再生成编号，故不在此处生成
					$("#ptable").append("<tr align=center>"+"<td class=table_num>"+"</td> <td class=table_pname>"+yourname+"</td> <td>"+"  "+"</td> <td>"+"  "+"</td> <td>"+"日常使用"+"</td> <td>"+now+"</td> </tr>");
					InsertRow($("#ptable tr:last td"));

				});
			$("#Refresh").click(function()
			{
				location.reload(true);

			});

			$(".table_num, .table_pname, .table_category, .table_specification, .table_detail").click(function()
			{
					//找到当前鼠标单击的td  
					var tdObj = $(this);  
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
					inputObj.css("text-align", "center");  
					inputObj.css("font-size", tdObj.css("font-size"));  
					inputObj.css("background-color", tdObj.css("background-color"));  
					//创建一个文本框 设置事件属性等 
					//var inputObj = NewTextBox(tdObj);
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
									SendRow(tdObj);
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
									SendRow(tdObj);

						});
			});  
		});
		</script>
    </head>	
    <body>
		<div class="Person_info">
			<?php
			if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
			$pname = $_SESSION['username'];
			echo $pname,"，欢迎你！";
			?>
			<a href="pinfomation.php" >个人信息修改</a>
		</div>
		<div class=<?php $pname ?> +"info">
			<br>你的目前设备使用情况：</br>
		</div>	
		<div>
			<button id="ADD"  class="button button-glow button-border button-rounded button-primary" type="button" >新增</button>
			<button id="Refresh"  class="button button-glow button-border button-rounded button-primary" type="button" >刷新</button>
		</div>
		<br>
		<div class="using_table">
            <form id="Form1" >
                <table id="ptable" border="1" cellspacing="0" cellpadding="5" rules="row">
						<th>编号</th>
                        <th>姓名</th>
                        <th>设备类别</th>
						<th>品牌规格</th>
						<th>备注</th>
                        <th>修改时间</th>
					<div class="table_body">
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "cad@cvg";
						$dbname = "设备管理系统";
						// 创建连接
						$conn = new mysqli($servername, $username, $password, $dbname);
						 // 检测连接
						if ($conn->connect_error) 
							{
								die("数据库连接失败: " . $conn->connect_error);
							} 
						$sql = "SELECT * FROM 设备使用状态 WHERE 使用人='$pname' ";
						$result = $conn->query($sql);
						  while($row = $result->fetch_assoc())
							{
								$name=$row["使用人"];
								$category=$row["设备类别"];
								$specification=$row["品牌规格"];
								$time=$row["修改时间"];
								$RID=$row["ID"];
								$Detail=$row["备注"];
					?>
								<tr align="center">		
								<td  class="table_num"><?php echo $RID ?></td>														
								<td  class="table_pname" ><?php echo $name ?></td>
								<td  class="table_category" ><?php echo $category ?></td>
								<td  class="table_specification" id=Edetail><?php echo $specification ?></td>
								<td class="table_detail"><?php echo $Detail ?></td>
								<td  class="table_time" ><?php echo $time ?></td>

								<td  class=DelButt></td>
								</tr>
					<?php					
							}							
						$conn->close();
					?>
					</div>
				</table>
            </form>		
		</div>
    </body>
</html>