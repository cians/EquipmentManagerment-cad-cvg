<!DOCTYPE html>
<link href="./css/bootstrap.css" rel="stylesheet">
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="./css/bootstrap-responsive.css" rel="stylesheet">
<link href="./css/bootstrap-responsive.min.css" rel="stylesheet">
<html lang="zh-cn" xml:lang="zh-cn">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/searchpage.css" rel="stylesheet" >
        <script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
		    <script src="./js/jquery.jeditable.js"  type="text/javascript"></script>
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(function()//页面加载完成后执行
        {
                <?php
                if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}  
               
                ?>
        querydb();
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
        }
        function SendRow(TdObj)
        {
          //列添加或变换顺序，此处会受影响
          //0=编号；1=设备类别；2=品牌规格；3=使用人；4=入库类别；5=备注；6=修改时间;7=存放地
            var tds=TdObj.parent("tr").children("td");//注意：当列表添加列时，此处要随之添列
            var tid=tds.eq(0).text(); //！！！id是数字要验证是否有影响
            var tpname=tds.eq(3).text();
            var tcategory=tds.eq(1).text();
            var tspecification=tds.eq(2).text();
            var tnote=tds.eq(5).text();
            var taddress=tds.eq(7).text();
            <?php
              if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
              echo "var yourname='{$_SESSION['username']}';";
              ?>
            //console.log(tpname);
            $.post("_editSearchPage.php",{id:tid,category:tcategory,specification:tspecification,pname:tpname,note:tnote,address:taddress,operator:yourname},function(pname)
            {
              if((pname!=yourname) && (pname!="修改失败") && pname !="服务器" && pname!="空闲")
                alert("你正在更改"+pname+"的使用记录，系统将把本次操作记录发送给"+pname);
                else if(pname=="修改失败")
                  alert(pname);
            });
        // location.reload(true) 没用 其实不需要刷新
        //location.href=location.href;
        };
          function exhibit(data)
                {
                    var tmp=$("#table tr:gt(0)");//获取大于0的索引行
                    tmp.empty();
                   // console.log(data);
                    var data=eval("("+data+")");//两边添加括号变为array
            // alert(data[0][0]);0=ID;1=类别；2=规格；3=购买日期；4=单价；5=入库类别；6=报销所属项目；7=当前使用人；8=使用日志；9=备注；10=修改时间;11存放地
                    for(var i=0;i<data.length;i++)
                    $("#table").append("<tr align=center>"+"<td class=table_id>"+data[i][0]+"</td><td class=table_category>"
                    +data[i][1]+"</td><td class=table_specification>"+data[i][2]+"</td><td class=table_user>"+data[i][7]+
                    "</td><td class=table_registration>"+data[i][5]+"</td><td class=table_note>"+data[i][9]+
                    "</td><td class=table_time>"+data[i][10]+"<td class=table_address>"+data[i][11]+"</td></tr>");
                    $("tr:odd").css("background-color","#CCCCCC");//偶数行变色
                    $(".table_user,.table_category,.table_specification,.table_note,.table_address").click(function()
                    {
                      td2textbox($(this));
                    })
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
            $("#category").html("所有种类");
            $("#status").html("所有状态");
            $("#registration").html("所有类别");
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

        $("#all_name,#cj,#cgy,#dqc,#qqh,#tq,#ytd,#wr,#kjl,#sq,#wxl,#jqh,#cgj,#lc,#ljy,#zcf,#hzy,#zsl,#zsj,#ljd,#xy,#jhq,#yz,#shl,#lsr,#lhm,#xwj,#ybb").click(function()
            {
              var ss=$.trim($(this).html());
               $("#people").html(ss);
               if(ss!="所有姓名")
                     $("#status").html("在用");
               querydb();
            })
            $("#all_kinds,#phone,#U,#camera,#earphone,#keyboard,#displayer,#disk,#computer,#others").click(function()
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
    <li id=lhm>刘浩敏</li>
    <li id=xwj>谢卫健</li>
    <li id=ybb>杨镑镑</li>
  </ul>
</div>

<div class="btn-group">
  <button id=category  class="btn dropdown-toggle" data-toggle="dropdown">所有种类</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_kinds>所有种类</li>
    <li id=phone>手机</li>
    <li id=camera>相机</li>
    <li id=earphone>耳机</li>
    <li id=U>U盘</li>
    <li id=U>移动电源</li>
    <li id=keyboard>键盘</li>
    <li id=displayer>显示器</li>
    <li id=disk>硬盘</li>
    <li id=computer>电脑</li>
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
  <button  id=registration  class="btn dropdown-toggle" data-toggle="dropdown">所有类别</button>
  <button class="btn dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <!-- dropdown menu links -->
    <li id=all_registration>所有类别</li>
    <li id=registed>入库资产</li>
    <li id=unregisted>日常耗材</li>
  </ul>
</div>
<input result="s" id="search" type="search" data-provide="typeahead" placeholder="搜索姓名、设备、编号、备注等">
<div>
    <table id=table border="1" cellspacing="0" cellpadding="5" rules="row">
        <tr>
        <th class=table_ids>编号</th>
        <th class=table_categorys>设备类别</th>
        <th class=table_specifications>品牌规格</th>
        <th class=table_users>当前使用人</th>
        <th class=table_registrations>入库类别</th>
        <th class=table_notes>备注</th>
        <th class=table_times>修改时间</th>
        <th class=table_addresses>存放地</th>
        </tr>
    </table>
 </div>
</div>
</body>

</html>