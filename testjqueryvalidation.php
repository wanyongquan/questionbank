<?php
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- the above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <title><?php echo $page_title?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $CFG->wwwroot.'/bootstrap/css/bootstrap.min.css'?>" rel="stylesheet">

    <link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
        <form id="testform" class="form-horizontal" method="post"
            role="form">
            <div class="form-group">
                <label>Email address</label> <input type="text"
                    class="form-control" name="email" />
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Favourite browser</label>
                <div class="col-lg-5">
                    <label class="col-lg-3 control-label">Editors</label>
                    <input class="form-control" type="text" id="e11"
                        required name="editors[]" />
                </div>
                <div class="col-lg-5">
                   <label> <input type="checkbox" id="chrome" class="group2"
                            name="browsers[]" value="chrome" /> Google
                            Chrome
                        </label>
                    </div>

                
            </div>
            <div class="form-group">
                <div class="col-lg-5">
                    <label>Email address</label> <input
                        class="form-control" type="text" id="e12"
                        required name="editors[]" />

                    <div class="col-lg-5">
                        <label> <input type="checkbox" id="firefox" class="group2"
                            name="browsers[]" value="firefox" /> Firefox
                        </label>
                    </div>
                    <label for="browsers[]" class="error"> </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5">
                    <label> <input type="checkbox" name="browsers[]"
                        value="ie" /> IE
                    </label>
                </div>
                <div class="col-lg-5">
                    <label> <input type="checkbox" name="browsers[]"
                        value="safari" /> Safari
                    </label>
                </div>
                <div class="col-lg-5">
                    <label> <input type="checkbox" name="browser1" class="group2"
                        value="opera" /> Opera browser1
                    </label>
                </div>
                <div class="col-lg-5">
                    <label> <input type="checkbox" name="browser2" class="group2"
                        value="other" /> Other browser2
                    </label>
                </div>
            </div>
      
    <div class="form-group">
        <label class="col-lg-3 control-label">Editors</label>
        <div class="col-lg-5">
            <input class="form-control" type="text" id="e1" required
                name="editors[]" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-5">
            <input class="form-control" type="text" id="e2"
                name="editors[]" />
        </div>
    </div>
    <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Validate</button>
                </div>
            </div>
        </form>
        <br>
        <h2>form2</h2>
        <form id="myForm" class="form-horizontal" method="post" role="form">
        <div class="form-group">
        <div class="col-lg-5">
            <label class="label-class">                
                <input type="checkbox" class="group1"  value="1" name="testing1"></input>
            </label>
          </div>
    </div>
    <div class="form-group">
    <div class="col-lg-5">
    <label class="label-class">
        <input type="checkbox" class="group1" value="1" name="testing2"></input>
    </label>
    </div>
    </div>
    <div class="form-group">
    <div class="col-lg-5">
    <label class="label-class">
        <input type="checkbox" class="group1"  value="1" name="testing3"></input>
    </label>
     </div>
    </div>
    <button type="submit" name="mybtn" class="btn btn-primary">validate</button>
</div>
</form>
    </div>
   <!-- Placed at the end of the document so the pages load faster -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="script/form-validator.min.js" type="text/javascript"></script>
    <script src="testjquery.js" type="text/javascript"></script>
    <script src="lib/jqueryvalidation/jquery.validate.js" type="text/javascript"></script>
    <script src="lib/jqueryvalidation/additional-methods.js" type="text/javascript"></script>
  </body>
  </html>
