<?php
require_once("inc/storeAddress.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/mailingList.js"></script>
  </head>
  <body>
<?php
if ( "1" == "2" ) {
    echo "Fatal error, please check code.<br />";
}
else {
?>
    <form id="addressForm" action="index.php" method="get">
      
       
        <p>
          <input type="text"  name="address" id="address" />
<input type="submit" value="Submit"> 
        </p>
        <p id="response"><?php echo(storeAddress()); ?></p>
      
    </form>
    
<?php
}
?>
  </body>
</html>