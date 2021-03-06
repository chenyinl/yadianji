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
    $data["imagepath"]=basename($_FILES["image"]["name"]);
    $data["id"]=$_POST["id"];
    if( file_exists($_FILES["image"]["tmp_name"])){
        $data["target_file"] = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $data["target_file"])) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }else{
        $data["target_file"] = "";
    }
    
    
    if( $_POST["action"]=="new"){
        if($obj->saveNewProduct($data)){
            $mesg =  "記錄成功";
        }else{
            $mesg = "記錄失敗：".$obj->errorMessage;
        }
    }
    if( $_POST["action"]=="update"){
        if($obj->updateProduct($data)){
            $mesg =  "更新成功";
        }else{
            $mesg = "更新失敗：".$obj->errorMessage;
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include( "views/head.phtml");?>
<body>
    <h1><?php echo $mesg;?></h1>
<div class="well">
<button 
    type="button" 
    class="btn btn-sm btn-primary"
    onclick="window.location.href = '/editoronly/manageProducts.php?cat=<?php echo $data["cat"];?>&subCat=<?php echo $data["subCat"];?>';"
>回到產品編輯頁面</button>
</div>
</body>
</html>
