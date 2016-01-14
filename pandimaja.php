<?php  
    require_once("functions.php");
    
    
	if(isset($_GET["delete"])){
		deleteMainData($_GET["delete"]);
	}
	if(isset($_GET["update"])){
        updateMainData($_GET["id"], $_GET["toode"], $_GET["ostuhind"], $_GET["myygihind"]);
	}
	
	$keyword = "";
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
        
        // otsime 
        $main_array = getAllData($keyword);
    
	}else{
	$main_array = getAllData();
	}
?>

Tere, <?=$_SESSION['email'];?>

<h1>Tabel</h1>

<form action="main.php" method="get">
    <input name="keyword" type="search" value="<?=$keyword?>" >
    <input type="submit" value="otsi">
<form>

<table border=1>
<tr>
	<th>ID</th>
	<th>Toode</th>
	<th>Ostuhind</th>
	<th>Müügihind</th>
	<th><a href="new.php">Lisa uus</a></th>
	<th><a href="?logout=1">Logi välja</a></th>
</tr>

<?php    
    // autod ükshaaval läbi käia
    for($i = 0; $i < count($main_array); $i++){
        // kasutaja tahab rida muuta
        if(isset($_GET["edit"]) && $_GET["edit"] == $main_array[$i]->id){
            echo "<tr>";
            echo "<form action='main.php' method='get'>";
            // input mida välja ei näidata
            echo "<input type='hidden' name='id' value='".$main_array[$i]->id."'>";
            echo "<td>".$main_array[$i]->id."</td>";
            echo "<td>".$main_array[$i]->product."</td>";
            echo "<td><input name='homework' value='".$main_array[$i]->purchase_cost."' ></td>";
            echo "<td><input name='date' value='".$main_array[$i]->sell_cost."' ></td>";
            echo "<td><input name='update' type='submit'></td>";
            echo "<td><a href='main.php'>cancel</a></td>";
            echo "</form>";
            echo "</tr>";
        }else{
            // lihtne vaade
            echo "<tr>";
            echo "<td>".$main_array[$i]->id."</td>";
            echo "<td>".$main_array[$i]->product."</td>";
            echo "<td>".$main_array[$i]->purchase_cost."</td>";
            echo "<td>".$main_array[$i]->sell_cost."</td>";
            echo "<td><a href='?delete=".$main_array[$i]->id."'>X</a></td>";
            echo "<td><a href='?edit=".$main_array[$i]->id."'>edit</a></td>";
			echo "<td><a href='new.php?edit_id=".$main_array[$i]->id."'>new.php</a></td>";
            echo "</tr>";
            
        }
        
        
        
        
    }
    
?>