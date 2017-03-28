<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <head>
        <title>人员数据库表信息</title>
    </head>
    <body>
	<div class=body align=center>
            <form name="myForm" >
                <table  border="1" cellspacing="0" cellpadding="8">
                    <caption><h2>人员一览表</h2></caption>
                        <th>姓名</th>
                        <th>年级</th>
                        <th>学号</th>
						<th>联系方式</th>
						<?php
						header("Content-Type:text/html;charset=utf8");
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