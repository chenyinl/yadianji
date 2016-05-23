function deleteProduct( id ){
    var choice = confirm("確定刪除此商品嗎？");
    if( !choice){
        return;
    }
    var http = new XMLHttpRequest();
    var url = "/editoronly/editAjax.php";
    var params = "id="+id;
    http.open("POST", url, true);

    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            alert(http.responseText);
            location.reload();
        }
    }
    http.send(params);
}

function editProduct( id ){
    window.location.href="/editoronly/editProduct.php?id="+id;
}
