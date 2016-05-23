<?php 
include(__DIR__."/../models/products.class.php");
$id = $_GET["id"];
$obj = new Products();
$data = $obj -> getProductById( $id );
include(__DIR__."/views/editProduct.phtml");

?>

