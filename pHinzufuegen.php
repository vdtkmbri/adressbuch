
<?php
    
    if(isset($_POST["einfuegen"]))
    {
        require 'config.php';
        
        $sql = "INSERT INTO `liste_von_personen` 
        (`Vorname`, `Nachname`, `Strasse`, `Ort`, `Kanton`, `PLZ`, `Land`, `Tel_Nummer`) 
        VALUES ('".$_POST['Vorname']."', '".$_POST['Nachname']."', '".$_POST['Strasse']."', 
        '".$_POST['Ort']."', '".$_POST['Kanton']."', '".$_POST['PLZ']."', '".$_POST['Land']."', 
        '".$_POST['Tel_Nummer']."');";

        if (mysqli_query($conn, $sql)) 
        {
            echo "Neue Person erfolgreich hinzugef&uuml;gt";
        } else 
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
        
        $conn->close();
        
        header("Location: adressbuch.php");
    }
?>
