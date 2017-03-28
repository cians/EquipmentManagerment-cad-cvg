<!DOCTYPE html>
<link href="./css/bootstrap.css" rel="stylesheet">
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="./css/searchpage.css" rel="stylesheet" >
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		    <script src="./js/jquery.jeditable.js"  type="text/javascript"></script>
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(function()//页面加载完成后执行
        {
                <?php
                if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}  
                $conn_edit = new mysqli("localhost", "root", "cad@cvg", "设备管理系统");
                ?>
          querydb();
          function exhibit(data)
                {
                    var tmp=$("#table tr:gt(0)");//获取大于0的索引行
                    tmp.empty();
                    // $("#table").append("<tr><th>"+"编号"+"</th><th>"+"设备类别"+"</th><th>"+"品牌规格"+"</th><th>"+"当前使用人"
                    // +"</th><th>"+"是否入库"+"</th><th>"+"备注"+"</th><th>"+"修改时间"+"</th></tr>");
                   // console.log(data);
                    var data=eval("("+data+")");//两边添加括号变为array
            // alert(data[0][0]);0=ID;1=类别；2=规格；3=购买日期；4=单价；5=是否入库；6=报销所属项目；7=当前使用人；8=使用日志；9=备注；10=修改时间
                    for(var i=0;i<data.length;i++)
                    $("#table").append("<tr align=center>"+"<td class=table_id>"+data[i][0]+"</td><td class=table_category>"
                    +data[i][1]+"</td><td class=table_specification>"+data[i][2]+"</td><td class=table_user>"+data[i][7]+
                    "</td><td class=table_registration>"+data[i][5]+"</td><td class=table_notes>"+data[i][9]+
                    "</td><td class=table_time>"+data[i][10]+"</td></tr>");
                    $("tr:odd").css("background-color","#CCCCCC");//偶数行变色
                }
         function querydb()
         {
               //location.reload();
               var pname=$("#people").html();
               var category = $("#category").html();
               var status = $("#status").html();
               var registration= $("#registration").html();
               //console.log(pname+category+status+registration);
               $.post("_searchbutton.php",{pname:pname,category:category,status:status,registration:registration},function(data)
               {
                 if(data==1)
                   alert("查询失败");
                 else
                    exhibit(data);
               })
         }
         function querydbinput()
         {
             var inputext=$.trim($("#search").val());
             console.log(inputext);
            $("#people").html("所有姓名");
            $("#category").html("所有类别");
            $("#status").html("所有状态");
            $("#registration").html("所有");
            $.post("_searchinput.php",{inputext:inputext},function(data)
             {
                 if(data==1)
                 alert("查询失败");
                 else
                 exhibit(data);
             })        
         }
        $(document).keydown(function(event)
        {
            if(event.keyCode=="13")
            {
                if($.trim($("#search").val()))
                {
                  // location.reload();
                    querydbinput();
                }

            }
        })
        
        $("#all_name,#cj,#cgy,#dqc,#qqh,#tq,#ytd,#wr,#kjl,#sq,#wxl,#jqh,#cgj,#lc,#ljy,#zcf,#hzy,#zsl,#zsj,#ljd,#xy,#jhq,#yz,#shl,#lsr").click(function()
            {
              var ss=$.trim($(this).html());
               $("#people").html(ss);
               if(ss!="所有姓名")
                     $("#status").html("在用");
               querydb();
            })
            $("#all_kinds,#phone,#pad,#camera,#earphone,#keyboard,#displayer,#disk,#others").click(function()
            {
              var ss=$.trim($(this).html());
               $("#category").html(ss);
               querydb();
            })
            $("#all_status,#occupied,#unoccupied").click(function()
            {
              var ss=$.trim($(this).html());
               $("#status").html(ss);
               if(ss=="空闲")
                    $("#people").html("所有姓名");
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
<div class="bodyc">
<div class="btn-group">
  <button id=people class="btn dropdown-toggle" data-toggle="dropdown">所有姓名</button>
  <button   class="btn dropdown-toggle" data-toggle="dropdown">
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
  <button id=category  class="btn dropdown-toggle" data-toggle="dropdown">所有类别</button>
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
    <li id=disk>硬盘</li>
    <li id=others>其他</li>
  </ul>
</div>
<div class="btn-group">
  <button id=status  class="btn dropdown-toggle" data-toggle="dropdown">所有状态</button>
  <button  class="btn dropdown-toggle" data-toggle="dropdown">
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
  <button  id=registration  class="btn dropdown-toggle" data-toggle="dropdown">所有</button>
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
<input result="s" id="search" type="search" data-provide="typeahead" placeholder="搜索设备、姓名等">
<div>
    <table id=table border="1" cellspacing="0" cellpadding="5" rules="row">
        <tr>
        <th class=table_id>编号</th>
        <th class=table_category>设备类别</th>
        <th class=table_specification>品牌规格</th>
        <th class=table_user>当前使用人</th>
        <th class=table_registration>是否入库</th>
        <th class=table_notes>备注</th>
        <th class=table_time>修改时间</th>
        </tr>
    </table>
 </div>
</div>
</body>

</html>