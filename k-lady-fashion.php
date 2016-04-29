<!DOCTYPE html>
<html lang="en">
<?php include( "views/head.phtml");?>
<body role="document">
<?php include( "views/navbar.phtml");?>
<div class="container theme-showcase" role="main">
<?php
$items = array(
    array( "imgurl" => "50775.jpg"),
    array( "imgurl" => "50776.jpg"),
    array( "imgurl" => "50777.jpg"),
    array( "imgurl" => "50778.jpg"),
    array( "imgurl" => "50779.jpg")
);
?>    
<?php include( "views/carousel.phtml");?>

</div><!-- /container -->
<?php include( "views/bootstrapjs.phtml");?>
</body>
</html>
