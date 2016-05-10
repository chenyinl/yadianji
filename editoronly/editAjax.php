<?php
/**
 * Delete product by ID
 */
include( __DIR__."/../models/products.class.php");
$id = $_POST["id"];
$obj = new Products();
if($obj->deleteProductById($id)){
    echo "刪除成功。";
}else{
    echo "刪除失敗！";
}

