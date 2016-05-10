<?php 
include(__DIR__."/../models/products.class.php");

include(__DIR__."/../config/category.php");
$categoryId = $_REQUEST["cat"];
$category=$_category[$categoryId];
$subCategoryId = $_REQUEST["subCat"];
$subCategory = $_subCategory[$subCategoryId];


$obj = new Products();
$results = $obj -> getProductsByCat($categoryId, $subCategoryId);
include(__DIR__."/views/listProducts.phtml");

?>

