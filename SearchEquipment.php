
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="./css/bootstrap-responsive.css" rel="stylesheet">
        <link href="./css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="./login_files/searchpage.css" rel="stylesheet" >
        <script src="./login_files/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		<script src="./login_files/jquery.jeditable.js"  type="text/javascript"></script>
        <script src="./login_files/jquery.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script type="text/javascript">

        $(function()
        {
                <?php
                if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}  
                $conn_edit = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
                ?>
          function exhibit(data)
                {
                    alert(data);

                }
         function querydb()
         {
               var pname=$("#people").html();
               var category = $("#category").html();
               var status = $("#status").html();
               var registration= $("#registration").html();
               //console.log(pname+category+status+registration);
               $.post("searchsql.php",{pname:pname,category:category,status:status,registration:registration},function(data)
               {
                 if(data==1)
                   alert("查询失败");
                 else
                    show(data);
               })
               setTimeout(function() {
                   location.reload();
               }, 100);
         }
            $("#all_name,#cj,#cgy,#dqc,#qqh,#tq,#ytd,#wr,#kjl,#sq,#wxl,#jqh,#cgj,#lc,#ljy,#zcf,#hzy,#zsl,#zsj,#ljd,#xy,#jhq,#yz,#shl,#lsr").click(function()
            {
              var ss=$.trim($(this).html());
               $("#people").html(ss);
               querydb();
            })
            $("#all_kinds,#phone,#pad,#camera,#earphone,#keyboard,#displayer,#others").click(function()
            {
              var ss=$.trim($(this).html());
               $("#category").html(ss);
               querydb();
            })
            $("#all_status,#occupied,#unoccupied").click(function()
            {
              var ss=$.trim($(this).html());
               $("#status").html(ss);
               querydb();
            })
           $("#all_registration,#registed,#unregisted").click(function()
            {
              var ss=$.trim($(this).html());
               $("#registration").html(ss);
               querydb();
            })
        })

        </script>

</head>
<body>

<div class="btn-group">
  <button id=people class="btn">所有姓名</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_name>所有姓名</li>
    <li id=cj >曹健</li>
    <li id=cgy>褚冠宜</li>
    <li id=dqc>丁奇超</li>
    <li id=wr>王儒</li>
    <li id=ytd>杨腾达</li>
    <li id=kjl>柯锦乐</li>
    <li id=tq>唐庆</li>
    <li id=qqh>钱权浩</li>
    <li id=sq>沈强</li>
    <li id=wxl>吴香利</li>
    <li id=jqh>蒋沁宏</li>
    <li id=cgj>陈国军</li>
    <li id=lc>李晨</li>
    <li id=ljy>李津羽</li>
    <li id=zcf>赵长飞</li>
    <li id=hzy>黄昭阳</li>
    <li id=zsl>张双力</li>
    <li id=zsj>翟尚进</li>
    <li id=ljd>罗俊丹</li>
    <li id=xy>许䶮</li>
    <li id=jhq>姜翰青</li>
    <li id=yz>杨哲</li>
    <li id=lsr>刘思睿</li>
    <li id=shl>孙汉林</li>
  </ul>
</div>

<div class="btn-group">
  <button id=category class="btn">所有类别</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_kinds>所有类别</li>
    <li id=phone>手机</li>
    <li id=camera>相机</li>
    <li id=earphone>耳机</li>
    <li id=pad>平板</li>
    <li id=keyboard>键盘</li>
    <li id=displayer>显示器</li>
    <li id=others>其他</li>
  </ul>
</div>
<div class="btn-group">
  <button id=status class="btn">所有状态</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_status>所有状态</li>
    <li id=occupied>在用</li>
    <li id=unoccupied>空闲</li>
  </ul>
</div>
<div class="btn-group">
  <button  id=registration class="btn">所有</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_registration>所有</li>
    <li id=registed>入库</li>
    <li id=unregisted>未入库</li>
  </ul>
</div>
<input id=search type=text data-provide="typeahead" placeholder="搜索设备、姓名等">
<div>
    <table id=table border="1" cellspacing="0" cellpadding="5" rules="row">
        <th>编号</th>
        <th>使用人</th>
        <th>设备类别</th>
        <th>品牌规格</th>
        <th>是否入库</th>
        <th>备注</th>
        <th>修改时间</th>

    </tabele>
 </div>
</body>

</html>