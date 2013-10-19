$(document).ready(function() {
});

function selectMovementType(){
	var combo = document.getElementById('comboInventario');
	var selecterType = combo.options[combo.selectedIndex].value;	
	var selecterCombo = document.getElementById('div'+selecterType);	
	var divAS = document.getElementById('divAS');
	var divIN = document.getElementById('divIN');
	var divBA = document.getElementById('divBA');
	var divTR = document.getElementById('divTR');
	var divDE = document.getElementById('divDE');	

	//Oculta los divs
	hideDiv(divAS);
	hideDiv(divIN);
	hideDiv(divBA);
	hideDiv(divTR);
	hideDiv(divDE);
	
	//muestra el div seleccionado
	selecterCombo.style.display = "block";

}

function showDiv(div){
	div.style.display = "block";
}

function hideDiv(div){
	div.style.display = "none";
}
