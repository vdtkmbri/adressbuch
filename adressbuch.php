<?php
    session_start();
    
    if(!isset($_SESSION['userID']))
    {
        echo "<html><body><h2><a href = 'anmeldefenster.html'>Bitte anmelden!</a><h2></body></html>";
        // funktioniert NICHT 
        // -> IDEE: ES SOLLTE DEN USER BEIM AUFRUF DIESER SITE OHNE ANMELDUNG ZURÜCK ZUM ANMELDEFENSTER SCHICKEN
        //header("Locaton: http://localhost/projekt_Adressbuch/adressbook/anmeldefenster.html");
        exit();
    }
    
    require 'config.php';
    
    $tabelle = "liste_von_personen";
    if(isset($_GET["order"])) $orderattr=$_GET["order"];
    if(isset($_GET["dir"])) $orderdir=$_GET["dir"];
    
    $parameter="sn=$sn&un=$un&pw=$pw&db=$db&tabelle=$tabelle";
    
?>

<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>Datenbank: "adressbuch"</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">
	<script type = "text/javascript" src = "js_adressbuch.js"></script>
	
</head>

<body id="body">
	
	<h2>Tabelle: "<?php echo $tabelle;?>"</h2>
	
	<?php
    	
    	$query = "SELECT * FROM $tabelle WHERE 1";
    	if(isset($orderattr)) $query = "$query ORDER BY $orderattr $orderdir";
    	
    	$result = $conn->query($query);
    	if(!$result) die ("Fatal Erro: query sql failed");
    	
	?>
	
	<form action = "pLoeschen.php" method = "get">
	
		<input type="hidden" name="sn" 		value="<?php echo($sn);        ?>">
		<input type="hidden" name="un" 		value="<?php echo($un);        ?>">
		<input type="hidden" name="pw" 		value="<?php echo($pw);        ?>">
		<input type="hidden" name="db" 		value="<?php echo($db);        ?>">
		<input type="hidden" name="tabelle" value="<?php echo($tabelle);   ?>">
		<input type="hidden" name="order" 	value="<?php echo($orderattr); ?>">
		<input type="hidden" name="dir" 	value="<?php echo($orderdir);  ?>">
		<br>
		
		<input class = "button" type="button" id ="addBtn" name = "hinzufuegen" 
         	value="Hinzuf&uuml;gen" onclick="oeffneDisplay(this)">
         	
		<input class = "button" type="submit" name = "loeschen" 
		value="Person(en) L&ouml;schen" onclick="checkboxFunktion()">
		
		<br>
		
		<table>
			
			<tr>
				<?php
				    print("<th colspan='$result->field_count'> '$tabelle' tabelle</th>");
				?>
			</tr>
			
			<tr>
				<?php
				    $columns = 0;
				    while ($fieldinfo = $result->fetch_field()) 
				    {
				        $fieldname = $fieldinfo->name;
				        
				        print(
				            "<th>$fieldname
    				        <a href='adressbuch.php?$parameter&order=$fieldname&dir=asc'>&uarr;</a>
    						<a href='adressbuch.php?$parameter&order=$fieldname&dir=desc'>&darr;</a>
                            </th>"
				            );
				        
				        $columns = $columns + 1;
				    }
				?>
			</tr>
			
			<?php 
			     while($row = mysqli_fetch_array($result))
			     {
			         print("<tr>");
    			         
			         for($i = 0; $i < $columns; $i++)
			         {
			             if($i === 0)
			             {
			                 print("<td>");
    			                 
    			                 print("<input type ='checkbox' name='chkName[]' value = '$row[$i]'>");
    			                 
			                 print("</td>");
			             }
			             else 
			             {
			                 print("<td>");
			                     print($row[$i]);
			                 print("</td>");
			             }
			         }
			         
			         print("</tr>\n");
			     }
			     
			?>
			
		</table>
		
	</form>   
	
	<form action="logout_session.php">
		<button class = "button" name = "logoutBtn" onclick="logoutFunktion()">Logout</button>
	</form>
	
         	
      <div id = "myModal" class = "modal">
      	
      	<div class="modalInhalt" >
      		
      		<span class="kreuz" id="kreuzID" onclick="schliesseDisplay()">&times;</span>
      		
      		<form action = "pHinzufuegen.php" method = "post">
         	
            <table id="einfuegeTable">
                <tr>
                	<td colspan=2>
                		<h2>F&uuml;lle die Textfelder aus</h2>
                	</td>
                	
                </tr>
                <tr>
                	<td>
                		<label>Vorname:<span style="color: red">*</span></label>
                	</td>
                	<td>
                		<input type = "text" name = "Vorname" id = "vname" required/>
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Nachname:<span style="color: red">*</span></label>
                	</td>
                	<td>
                		<input type = "text" name = "Nachname" id = "nname" required/>
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Strasse:</label>
                	</td>
                	<td>
                		<input type = "text" name = "Strasse" id = "str" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Ort:</label>
                	</td>
                	<td>
                		<input type = "text" name = "Ort" id = "ort" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Kanton:</label>
                	</td>
                	<td>
                		<input type = "text" name = "Kanton" id = "knt" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>PLZ:</label>
                	</td>
                	<td>
                		<input type = "text" name = "PLZ" id = "plz" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Land:</label>
                	</td>
                	<td>
                		<input type = "text" name = "Land" id = "land" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<label>Tel. Nr:</label>
                	</td>
                	<td>
                		<input type = "text" name = "Tel_Nummer" id = "telnr" />
                	</td>
                </tr>
                <tr>
                	<td>
                		<span style="color: red">min. Angaben: *</span>
                	</td>
                	<td>
                		<input class = "button" type = "submit" value ="Einf&uuml;gen" name = "einfuegen"/>
                		<input class = "button" type = "reset" value ="Reset" name = "reset"/>
                		<button class = "button" type="button" onclick = "schliesseDisplay()">Schliessen</button>
                	</td>
                </tr>
             	
                
            </table>
            
         </form>
        
      	</div>
          
      </div>
</body>

</html>