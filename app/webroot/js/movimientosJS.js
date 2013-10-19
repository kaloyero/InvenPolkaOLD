$(document).ready(function() {
});

function selectMovementType(){
	var combo = document.getElementById('comboInventario');
	var selecterType = combo.options[combo.selectedIndex].value;	
	var divProyecto = document.getElementById('divProyecto');
	var divDepositoDest = document.getElementById('divDepositoDest');
	var divUbicacionDest = document.getElementById('divUbicacionDest');	

	hideDiv(divProyecto);
	hideDiv(divDepositoDest);
	hideDiv(divUbicacionDest);

	if (selecterType == 'P'){
		showDiv(divProyecto);
	} else if (selecterType == 'D'){
		showDiv(divProyecto);
	} else if (selecterType == 'I'){		

	} else if (selecterType == 'B'){		

	} else if (selecterType == 'T'){
		showDiv(divDepositoDest);
		showDiv(divUbicacionDest);
	}
}

function showDiv(div){
	div.style.display = "block";
}

function hideDiv(div){
	div.style.display = "none";
}
