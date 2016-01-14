<?php

	$database = "if15_brenbra_1"

	function loginUser ($username, $email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE username=? AND email=? AND password=?");
                // k�sim�rkide asendus
                $stmt->bind_param("sss", $username, $email, $hash);
                //ab tulnud muutujad
                $stmt->bind_result($id_from_db, $email_from_db);
                $stmt->execute();
                
                // teeb p�ringu ja kui on t�ene (st et ab oli see v��rtus)
                if($stmt->fetch()){
                    
                    // Kasutaja email ja parool �iged
                    echo "Kasutaja logis sisse id=".$id_from_db;
					$_SESSION["email"] = $email_from_db;
					$_SESSION["id"] = $id_from_db;
					
					
                    header("Location: pandimaja.php");
                }else{
                    echo "Wrong credentials!";
                }
                
                $stmt->close();
	}
	
	function createUser ($create_username, $create_email, $hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (username, email, password) VALUES (?,?,?)");
                
                //kirjutan v�lja error
                //echo $stmt->error;
                //echo $mysqli->error;
                
                // paneme muutujad k�sim�rkide asemel
                // ss - s string, iga muutuja koht 1 t�ht
                $stmt->bind_param("sss",$create_username, $create_email, $hash);
                
                //k�ivitab sisestuse
                $stmt->execute();
                $stmt->close();
	}
	
	function getSingleProductData($id){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);

        $stmt = $mysqli->prepare("SELECT toode, ostuhind, myygihind FROM eksam_pandimaja WHERE id=? AND deleted IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->bind_result($product, $purchase_cost, $sell_cost);
        $stmt->execute();
        
        
        $product = new StdClass();
        
        // kas sain rea andmeid
        if($stmt->fetch()){
            
            $product->product = $product;
            $product->purchase_cost = $purchase_cost;
			$product->sell_cost = $sell_cost;
            
        }else{
            // ei tulnud 
            // kui id ei olnud (vale id)
            // v�i on kustutatud (deleted ei ole null)
            header("Location: main.php");
        }
        
        $stmt->close();
        $mysqli->close();
        
        return $product;
        
    }
	function updateProductData($product_id, $product, $purchase_cost, $sell_cost){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        
        $stmt = $mysqli->prepare("UPDATE eksam_pandimaja SET toode=?, ostuhind=?, myygihind=? WHERE id=?");
        $stmt->bind_param("sssi", $product, $purchase_cost, $sell_cost, $product_id);
        $stmt->execute();
        
        // t�hjendame aadressirea
        header("Location: main.php");
        
        $stmt->close();
        $mysqli->close();
        $mysqli->close();
		
		
        
    }
	
	
	
?>