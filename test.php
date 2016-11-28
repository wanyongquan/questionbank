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
        <form id="testform" class="form-horizontal" method="post" role="form">
            <div class="form-group">
                <label>Email address</label>
                <input type="text" class="form-control" name="email" />
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Favourite browser</label>
                <div class="col-lg-5">
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="chrome" /> Google Chrome
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="firefox" /> Firefox
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="ie" /> IE
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="safari" /> Safari
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="opera" /> Opera
                        </label>
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="browsers[]"
                            value="other" /> Other
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Editors</label>
                <div class="col-lg-5">
                    <input class="form-control" type="text"
                        name="editors[]" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-5">
                    <input class="form-control" type="text"
                        name="editors[]" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Validate</button>
                </div>
            </div>
        </form>
    </div>
   <!-- Placed at the end of the document so the pages load faster -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="script/form-validator.min.js" type="text/javascript"></script>
    <script src="test.js" type="text/javascript"></script>
    <script src="lib/bootstrapValidator/js/bootstrapValidator.js" type="text/javascript"></script>
  </body>
  </html>
