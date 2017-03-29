<!DOCTYPE html>
<html >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <head>
        <title>人员数据库表信息</title>
		<script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		<script>
			$(function()
			{
				$("tr:odd").css("background-color","#CCCCCC");//偶数行变色
			})
		</script>
    </head>
	<style>
		#name{
			width: 80px;
		}
		#grade{
			width:80px;
		}
		#num{
			width:160px;
		}
		#connection{
			width:180px;
		}
		</style>
    <body>
	<div class=body align=center>
            <form name="myForm" >
                <table  border="1" cellspacing="0" cellpadding="5">
                    <caption><h2>人员一览表</h2></caption>
                        <th id=name>姓名</th>
                        <th id=grade>年级</th>
                        <th id=num>学号</th>
						<th id=connection>联系方式</th>
						<?php
						header("Content-Type:text/html;charset=utf8");
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
						$sql = "SELECT * FROM 人员";
						$result = $conn->query($sql);
						  while($row = $result->fetch_assoc())
							{
														$name=$row["姓名"];
														$grade=$row["年级"];
														$num=$row["学号"];
														$phone=$row["联系方式"];
													  
												?>
											<tr align="center">
											<td><?php echo $name ?></td>
											<td><?php echo $grade ?></td>
											<td><?php echo $num ?></td>
											<td><?php echo $phone ?></td>
											</tr>
											<?php
							}
							$conn->close();
						?>
				</table>
            </form>
		</div>
    </body>
</html>