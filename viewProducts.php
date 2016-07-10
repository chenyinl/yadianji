<?php
include(__DIR__."/config/category.php");
include(__DIR__."/models/products.class.php");
$categoryId = $_GET["cat"];
$category=$_category[$categoryId];
$subCategoryId = $_GET["subCat"];
$subCategory = $_subCategory[$subCategoryId];

$obj = new Products();
$items = $obj -> getProductsByCat($categoryId, $subCategoryId);
?>
<!DOCTYPE html>
<html lang="en">
<?php include( "views/head.phtml");?>
<body role="document">
<?php include( "views/navbar.phtml");?>
<div class="container theme-showcase" role="main">
<h1><b></b><?php echo $category;?>  
    <span class="athen-subcategory"><?php echo $subCategory;?></span></h1>
<?php if( !$items):?>
抱歉，目前沒有產品
<?php else:?>
<?php include("views/carousel.phtml");?>
<?php endif;?>
<div>

</div><!-- /container -->
<?php include( "views/bootstrapjs.phtml");?>
</body>
</html>
