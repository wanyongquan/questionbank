<?php
    session_start();
    if (!empty($_POST)){
       $username =  $_POST['user'];
       $$_SESSION['username'] = $username;
       if (isset($_POST['prg'])){
            //header("location: form1.php", true, 303 );
       }
    }
    if (!empty($_GET)){
        $username = $_GET['qtype'];
    }
?>
<html>
<body>
<form action="process.php" method="post" autocomplete="off">
    <input type="text" name="user" value="<?php echo (isset($username)? $username: 'please enter'); ?>">
    <input type="hidden" name="prg">
    <input type="submit" value="submit this">
</form>
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
