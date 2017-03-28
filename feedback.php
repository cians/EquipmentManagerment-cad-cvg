<!DOCTYPE html>
<link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="./js/jquery-1.7.2.min.js"  type="text/javascript" charset="utf-8"></script>
        <script>
            $(function()
            {
                $(".btn").click(function()
                {
                    var str= $.trim($(".inputtext").val());
                    console.log(str);
                    if(str)
                    $.post('_feedbacktext.php',{str:str},function(data)
                    {
                        if(data==1)
                        alert("errors!");
                        else
                        alert("提交成功！");
                    })
                    $(".inputtext").empty();
                })
            });
        </script>
    <style>
       .inputtext{
            font-size:16px;
            float:left;
            width:600px;
        }
        .d{
            float:left;
        }
        .btn{
            position:relative;
        }
        .bodyc{
            margin:8px;
        }
     </style>

    </head>
        <body>
        <div class="bodyc">
         <font face="微软雅黑"><p>BUG反馈可以戳我QQ：cians@qq.com</p></font>
         <div class=d> 
          <textarea type="text" class="inputtext" rows=10 cols=100></textarea>
         </div>      
         <div style="clear:both">
             <button class="btn" type="submit">提交</button>
         </div>
        </div>
   </body>
</html>