<!DOCTYPE html>
<html lang="en">
<?php include( "views/head.phtml");?>
<body role="document">
<?php include( "views/navbar.phtml");?>
<div class="container theme-showcase" role="main">
<?php
$items = array(
    array( "imgurl" => "50769.jpg"),
    array( "imgurl" => "50773.jpg"),
    array( "imgurl" => "50780.jpg"),
    array( "imgurl" => "50781.jpg"),
    array( "imgurl" => "50782.jpg")
);
?>
<?php include( "views/carousel.phtml");?>

</div><!-- /container -->
<?php include( "views/bootstrapjs.phtml");?>
</body>
</html>
