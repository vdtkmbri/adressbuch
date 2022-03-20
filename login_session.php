<?php
    require 'config.php';
    
    if(isset($_POST["login"])) // ist man auf diese Site durch antippen des Login Buttons gekommen
    {
        $username = $_POST["un"];
        $passwort= $_POST["pw"];
        
        if(empty($username) || empty($passwort)) // Wenn eines der Felder leer -> gehe zurück zum anmeldefenster
        {
            echo "<html><body><h2><a href = 'anmeldefenster.html'>Error: leeres Feld!</a><h2></body></html>";
            
            exit();
        }
        else if(empty($username) && empty($passwort)) // Wenn beide der Felder leer -> gehe zurück zum anmeldefenster
        {
            echo "<html><body><h2><a href = 'anmeldefenster.html'>Error: leere Felder!</a><h2></body></html>";
            
            exit();
        }
        else 
        {
            // SQL Injection in AAC gelernt -> Gegenmittel "Prepared Statements" 
            $query ="SELECT * FROM users WHERE benutzername = ?";
            $prepStatement = mysqli_stmt_init($conn);
            
            if(!mysqli_stmt_prepare($prepStatement, $query)) // prüefen ob der query funktioniert
            {
                echo "<html><body><h2><a href = 'anmeldefenster.html'>Error: SQL Error!</a><h2></body></html>";
                
                exit();
            }
            else 
            {
                mysqli_stmt_bind_param($prepStatement, "s", $username);
                mysqli_stmt_execute($prepStatement);
                $result = mysqli_stmt_get_result($prepStatement);
                
                if($row = mysqli_fetch_assoc($result))
                {
                    //passt das angegebene Passwort mit dem auf DB überein?
                    $pwDB = password_hash($row['passwort'], PASSWORD_DEFAULT); 
                    
                    $pwCheck = password_verify($passwort, $pwDB); // pwDB muss ein hash sein
                    
                    if($pwCheck  == false)
                    {
                        echo "<html><body><h2><a href = 'anmeldefenster.html'>Error: falsches Passwort!</a><h2></body></html>";
                        
                        exit();
                    }
                    else if($pwCheck == true)
                    {
                        // Eintritt zum Adressbuch
                        session_start();
                        $_SESSION[userID] = $row['ID'];
                        
                        header("Location: adressbuch.php?erfolgreich=erfolgreich");
                        exit();
                    }
                    else
                    {
                        echo "<html><body><h2><a href = 'anmeldefenster.html'>Error: falsches Passwort!</a><h2></body></html>";
                        
                        exit();
                    }
                }
            }
                    
        }
    }
    else
    {
        header("Location: anmeldefenster.html");
        exit();
    }
?>