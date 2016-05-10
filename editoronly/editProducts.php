<?php 
include(__DIR__."/../models/products.class.php");
$obj = new Products();
if( isset( $_POST["action"])){
    $data["title"] = $_POST["title"];
    $data["description"] = $_POST["description"];
    $data["price"] = $_POST["price"];
    $data["cat"] = $_POST["cat"];
    $data["subCat"] = $_POST["subCat"];
    $target_dir = __DIR__."/../productImage/";
    $data["target_file"] = $target_dir . basename($_FILES["image"]["name"]);
    $data["imagepath"]=basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $data["target_file"])) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }
    
    $obj->saveNewProduct($data);
}
include(__DIR__."/../config/category.php");
$categoryId = $_REQUEST["cat"];
$category=$_category[$categoryId];
$subCategoryId = $_REQUEST["subCat"];
$subCategory = $_subCategory[$subCategoryId];


$obj = new Products();
$results = $obj -> getProductsByCat($categoryId, $subCategoryId);
include(__DIR__."/views/listProducts.phtml");

?>

