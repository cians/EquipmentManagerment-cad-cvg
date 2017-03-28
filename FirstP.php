<!DOCTYPE html>
<link href="./css/FirstP.css" rel="stylesheet" type="text/css">
<link href="./css/buttons.css" rel="stylesheet" type="text/css">
<html lang="zh-cn" xml:lang="zh-cn">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <head>
		<script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		<script src="./js/jquery.jeditable.js"  type="text/javascript"></script>
		<script type="text/javascript" charset="utf-8">
		//JS函数在html中是通过相应的事件触发的
		function DelRow(ID,cate,spec)
		{
			<?php
				if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
				echo "var yourname='{$_SESSION['username']}';";
			?>
			$.post("_delete.php",{rid:ID,operator:yourname,category:cate,specification:spec},function(status)
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
			//0=编号；1=姓名；2=设备类别；3=品牌规格；4=备注；5=修改时间
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
				$.post("_edit.php",{id:tid,pname:tpname,category:tcategory,specification:tspecification,detail:tdetail,time:ttime,operator:yourname},function(pname)
				{
					if((pname!=yourname) && (pname!="修改失败") && pname!="空闲")
						alert("你正在更改"+pname+"的使用记录，系统将把本次操作记录发送给"+pname);
					else if(pname=="修改失败")
							alert(pname);
					else if(pname=="空闲")
							alert("当你将使用人置为了空闲，系统记为 你归还了该设备");
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
			$.post("_insert.php",{id:tid,pname:tpname,category:tcategory,specification:tspecification,detail:tdetail,time:ttime},function(pname)
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
			$("#read").click(function()
			{
			    	<?php
					if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
					echo "var yourname='{$_SESSION['username']}';";
					?>
				$.post("_markread.php",{yourname:yourname},function(data)
				{
					if(data=="errors")
					alert("标记已读出错");
				})

			});
			$(".DelButt").click(function()  // 删除按钮
			{
				var RowID=$(this).parent("tr").children("td").eq(0).text();
				var category=$(this).parent("tr").children("td").eq(2).text();
				var specification=$(this).parent("tr").children("td").eq(3).text();
				var r=confirm("你确定要删除"+RowID+"这一行吗？");
				 if (r==true)
					{
					DelRow(RowID,category,specification);
					}
			});
			$("#ADD").click(function()//添加按钮
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
									tdObj.html(inputObj.val());
									//获取一行的所有列
								  if(tdObj.text()!=oldText)
									SendRow(tdObj);
									break;
								case 27:
									tdObj.html(oldText);
									break;
							}
						}).blur(function()
						{
									//bug 在IP地址访问时，没有执行,没有审查元素--因为与input.blur冲突了 = = 
									tdObj.html(inputObj.val());
								 if(tdObj.text()!=oldText)
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
			echo "<p>",$pname,"，欢迎你! ";
			?>
			<a href="pinfomation.php?name=yourname" >个人信息修改</a></p>
		</div>
			<?php
			//读取异常操作记录
			$conn_query = new mysqli("localhost", "root", "cad@cvg", "equipmentdatabase");
			$sql_unusual="SELECT * FROM 异常操作记录 WHERE (被修改人='$pname'AND 已读=0)";
			$res_unusual=$conn_query->query($sql_unusual);
			if($res_unusual&&$res_unusual->num_rows>0)
			{
				echo "注意：";
				echo "<blockquote>";
				while($uRows = $res_unusual->fetch_assoc())
					{
						echo $uRows['操作人'],"于",$uRows['修改时间'],"在你的使用清单里添加了",$uRows['品牌规格']," ",$uRows['设备类别'],"(编号：",$uRows['设备ID'],")","<br>";
					}
				echo "</blockquote>";
				echo "<a id=read href=FirstP.php >已读</a>";
				//bug 已读没点击就被标记为1了--。html JavaScript在客户端运行，但是<?php 里的内容在提交时就会在服务器运行。
			}
			$conn_query->close();
			?>
		<div class=<?php $pname ?> +"info">
			你的目前设备使用情况：
		</div>	
		<div>
			<button id="ADD"  class="button button-glow button-border button-rounded button-primary" type="button" >新增</button>
			<button id="Refresh"  class="button button-glow button-border button-rounded button-primary" type="button" >刷新</button>
		</div>
		<br>
		<!--正在使用的设备列表-->
		<div class="using_table">
            <form id="Form1" >
                <table id="ptable" border="1" cellspacing="0" cellpadding="5" rules="row">
					<div class="table_body">
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "cad@cvg";
						$dbname = "equipmentdatabase";
						// 创建连接
						$conn = new mysqli($servername, $username, $password, $dbname);
						 // 检测连接
						if ($conn->connect_error) 
							{
								die("数据库连接失败: " . $conn->connect_error);
							} 
						$sql = "SELECT * FROM 设备使用状态 WHERE 当前使用人='$pname' ";
						$result = $conn->query($sql);
						if($result->num_rows>0)
						{
						?>
							<tr id="table_header">
							<th>编号</th>
							<th>姓名</th>
							<th>设备类别</th>
							<th>品牌规格</th>
							<th>备注</th>
							<th>修改时间</th>
							</tr>
						<?php			
						}
						else
						echo "           无";
						  while($row = $result->fetch_assoc())
							{
								$name=$row["当前使用人"];
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
								<td  class="table_specification"><?php echo $specification ?></td>
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