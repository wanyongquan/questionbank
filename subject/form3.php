<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Example</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript">
/*         $(function() {
            $('input').click(function() {
                $.ajax({
                    type: "POST"
                    , url: "process.php"
                    , data: "id=453&action=test" 
                    , beforeSend: function(){

                    } 
                    , complete: function(){ 
                    }  
                    , success: function(html){ 
                        alert(html);        
                    }
                });
            });
        }); */
        $(document).ready(function(){
            $("#btnok").click(function(){
                //alert('btn clicked');
                $.ajax({
                    type:"POST",
                    url:'process2.php',
                    data:$("#form1").serialize(),          
                    success:function(data, status){
                        //
                    }
                });
                //$("#form1").submit();
            });
        });
    </script>
</head>

<body>
<form name="form1" method="post">
    <input name="user" value=""></input>

    <div id="main"><input type="button" name="btnok" id="btnok" value="Click me"></div>
</form>
</body>
</html>