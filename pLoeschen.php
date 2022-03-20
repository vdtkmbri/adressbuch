<?php
    require 'config.php';
    
    if (isset($_GET["loeschen"]))
    {
        $checkboxen = $_GET['chkName'] ;
        
        for ($i=0; $i < count($checkboxen); $i++) 
        {
            $query="DELETE FROM `liste_von_personen` WHERE `liste_von_personen`.`ID` = ".$checkboxen[$i]. "";
            print($query);
            mysqli_query($conn, $query);
        }
        
        header("Location: adressbuch.php");
    }
   
    mysqli_close($conn);
   
?>