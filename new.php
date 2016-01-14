<?php
    require_once("functions.php");
	
	
	if(isset($_GET["update"])){
        updateProductData($_GET["product_id"], $_GET["product"], $_GET["purchase_cost"], $_GET["sell_cost"]);
	}
     
    //kas muutuja on aadressireal
    if(isset($_GET["edit_id"])){
        //trükin aadressirealt muutuja
        echo $_GET["edit_id"];
        
        //küsin andmed
        $car = getSingleProductData($_GET["edit_id"]);
        var_dump($product);
        
    }else{
        
        //kui muutujat ei ole,
        // ei ole mõtet siia lehele tulla
        // suunan tagasi table.php
        header("Location: main.php");
        
    }
?>
<form action="new.php" method="get" >
    <input name="product_id" type="hidden" value="<?=$_GET["edit_id"];?>">
    <input name="product" type="text" value="<?=$product->product;?>" ><br>
    <input name="purchase_cost" type="text" value="<?=$product->purchase_cost;?>"><br>
	<input name="sell_cost" type="text" value="<?=$product->sell_cost;?>"><br>
    <input name="update" type="submit" >
</form>
