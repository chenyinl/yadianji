<?php
include( __DIR__."/../config/database.php");
class products
{
    private $db;
    function __construct(){
        $this->db = new mysqli(DB_ADDR, DB_USER, DB_PW, DB_NAME);
        if ($this->db->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

          
            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $this->db->connect_errno . "\n";
            echo "Error: " . $this->db->connect_error . "\n";
            exit;
        }
    }
    
    public function saveNewProduct( $data ){
        $sql = "INSERT INTO product_list 
        (title,description, category, subcategory, price, imagepath)
        value( '".$data["title"]."','".$data["description"]."','".$data["cat"]."','".$data["subCat"]."','".$data["price"]."','".$data["imagepath"]."')";
        
        if( $this->db->query( $sql) ===TRUE){
            $this->message = "記錄成功";
            return true;
        }else{
            $this->errorMessage = $this->db->error;
            return false;
        }
    }
    
    public function deleteProductById( $id ){
        $sql = "DELETE FROM product_list
        WHERE id=".$id;
        
        if( $this->db->query( $sql) ===TRUE){
            $this->message = "刪除成功";
            return true;
        }else{
            $this->errorMessage = $this->db->error;
            return false;
        }
    }
    
    public function getProductsByCat( $category, $subCategory){
        
        $mysqli = new mysqli(DB_ADDR, DB_USER, DB_PW, DB_NAME);
        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

          
            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            exit;
        }
        $sql = "SELECT * FROM product_list WHERE category=".$category." && subcategory=".$subCategory.";";
        if (!$result = $mysqli->query($sql)) {
            // Oh no! The query failed. 
            echo "Sorry, the website is experiencing problems.";

            // Again, do not do this on a public site, but we'll show you how
            // to get the error information
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        }

        // Phew, we made it. We know our MySQL connection and query 
        // succeeded, but do we have a result?
        if ($result->num_rows === 0) {
            // Oh, no rows! Sometimes that's expected and okay, sometimes
            // it is not. You decide. In this case, maybe actor_id was too
            // large? 
            return false;
            echo "We could not find a match for ID , sorry about that. Please try again.";
            exit;
        }

        $resultArray=[];
        while( $row = $result->fetch_assoc()){
            $resultArray[]=$row;
        }
      

        // Now, let's fetch five random actors and output their names to a list.
        // We'll add less error handling here as you can do that on your own now
       

// The script will automatically free the result and close the MySQL
// connection when it exits, but let's just do it anyways
$result->free();
$mysqli->close();
        
        
        
        return $resultArray;
    }
}
