//------------------------- Checkboxen -----------------------------------------//
// Zum schauen ob mind. eine Checkbox gewählt worden ist
function checkboxFunktion() 
{
	var inputElem = document.getElementsByTagName("input");
	var count = 0;
	
	for (var i=0; i<inputElem.length; i++) 
	{
		// zähle die anzahl input elemente, die typ checkbox und checked sind
		if (inputElem[i].type === "checkbox" && inputElem[i].checked === true) 
		{
			count++;
		}
	}
	// wenn weniger als 1 checkbox gewählt wurden dann alert sonst confirm
	if(count < 1)
	{
		alert(unescape("W%E4hle mindestens eine Person!"));
	}
	else
	{
		confirm(unescape("L%F6schen best%e4tigen!"));
		if(confirm() === false)
		{
			// stoppt submit button um eine form zu senden "return false" macht das nicht
			event.preventDefault(); 
		}
	}
}

//------------------------- Popup-Fenster fürs Einfügen ---------------------------//
// öffnet ein Popup-Fenster um Personen einzüfügen
function oeffneDisplay(n)
{
	var modal = n.ownerDocument.getElementById("myModal");
	
	modal.style.display = "block";
}

// Schliesst das Popup-Fenster 
function schliesseDisplay() 
{
    document.getElementById("myModal").style.display= "none";
}

//Schliesst das Popup-Fenster wenn Escape-Key gedruckt wird
document.onkeydown = function(evt) 
{
    if (evt.keyCode == 27) {
    	document.getElementById("myModal").style.display= "none";
    }
};
//---------------------------------------------------------------------------------//