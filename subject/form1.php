<?php
 /*    if (!empty($_POST)){
       $username =  $_POST['user'];
       echo $username;
       header("location: form1.php", true, 303 );
    } */
    
?>
<html>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
   
<body>
<form method="post" id="form1" data-toggle="validator">
    <input type="text" name="user" id="user" required></input>
    
    <input type="submit" name="btnok" id="btnok" value="submit this">
    
</form>
<form id="interviewForm" class="form-horizontal" >
    <div class="form-group">
        <label class="col-lg-3 control-label">Programming Languages</label>
        <div class="col-lg-2">
        <input type="text" name="email">
        
        </div><div class="col-sm-2 control-label">
            <label for="question_answer_option1">选项1</label></div>
        <div class="col-lg-4">
        
            <div >
                <label>
                   <input type="checkbox" id="1" name="languages1[]" value="net" data-bv-notempty="true" data-bv-message="please set at" /> .Net33
                </label>
            </div>
            <div class="col-sm-2 control-label">
            <label for="question_answer_option1">选项2</label></div>
           <div class="col-lg-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="2" name="languages1[]" value="java" /> Java
                </label>
            </div>
        </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages[]" value="c" data-bv-notempty="true" data-bv-message="please set 222" /> C/C++
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages[]" value="php" /> PHP
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages[]" value="perl" /> Perl
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages[]" value="ruby" /> Ruby
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages[]" value="python" /> Python
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="languages" value="javascript" /> Javascript
                </label>
            </div>
            
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Editors</label>
        <div class="col-lg-4">
            <select class="form-control" name="editors[]" multiple="multiple" style="height: 200px;">
                <option value="" disabled>Choose 2 - 3 editors</option>
                <option value="atom">Atom</option>
                <option value="eclipse">Eclipse</option>
                <option value="netbeen">NetBean</option>
                <option value="nodepadplusplus">Nodepad++</option>
                <option value="phpstorm">PHP Storm</option>
                <option value="sublime">Sublime</option>
                <option value="webstorm">Web Storm</option>
            </select>
        </div>
    </div>
    <input type="submit" value="submit">
</form>
<form id="form2">
    <div class="form-group">
        <label class="control-label" for="firstname">Nome:</label>
        <div class="input-group">
            <span class="input-group-addon">$</span>
            <input class="form-control" placeholder="Insira o seu nome próprio" name="firstname" type="text" />
        </div>
    </div>
        
    <div class="form-group">
        <label class="control-label" for="lastname">Apelido:</label>
        <div class="input-group">
            <span class="input-group-addon">€</span>
            <input class="form-control" placeholder="Insira o seu apelido" name="lastname" type="text" />
        </div>
    </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/bootstrapValidator.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        /* $("#btnok").click(function(e){
            //alert('btn clicked');
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:'process2.php',
                //data:$("#form1").serialize(),
                data:"user=1",
                success:function(data, status){
                    //
                    alert('success');
                    window.location="form2.php?qtype=" + 1;
                }
            });
            //$("#form1").submit();
        }); */
       $("#interviewForm").bootstrapValidator();
        
        $("#form1").on('submit', function(e){
            alert('on submit');
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:'process2.php',
                //data:$("#form1").serialize(),
                data:"user=1",
                success:function(data, status){
                    //
                    alert('success');
                    window.location="form2.php?qtype=" + 1;
                }
            });
        });

        
    });
</script>
</body>
</html>
