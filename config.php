<?php
    if(!function_exists("mysqli_init") && !extension_loaded("mysqli")) die ("Fatal Error in mysqli_init!");
    
    $sn      = "localhost";
    $un      = "root";
    $pw      = "";
    $db      = "adressbuch";
    $tabelle = "users";
    
    // Verbinde zu mysql Datenbank-Server
    $conn = new mysqli($sn, $un, $pw, $db);
    $conn->set_charset("utf8");
    
    if($conn->connect_error)die("Fatal Error in Connection! <a href='anmeldefenster.html'>");
    
?>
