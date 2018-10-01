function addStudent(){
	var table = document.getElementById("students");

	var sName = document.getElementById("name").value;
	var sSurname = document.getElementById("surname").value;
	var sFaculty = document.getElementById("faculty").value;

	if(check()){
		var newRow = table.insertRow(table.length);
		var cell1 = newRow.insertCell(0);
		var cell2 = newRow.insertCell(1);
		var cell3 = newRow.insertCell(2);

		cell1.innerHTML = sName;
		cell2.innerHTML = sSurname;
		cell3.innerHTML = sFaculty;
	}
}

function check(){
	var empty = true;

	var sName = document.getElementById("name").value;
	var sSurname = document.getElementById("surname").value;

	if(sName == ""){
		var elem = document.getElementById("name");
		elem.classList.add("error");
		empty = false;
	}
	if(sSurname == ""){
		var elem = document.getElementById("surname");
		elem.classList.add("error");
		empty = false;
	}
	return empty;
}