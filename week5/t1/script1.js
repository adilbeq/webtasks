function calc() {
	var s11 = parseInt(document.getElementById("s11").value);
	var s12 = parseInt(document.getElementById("s12").value);
	var s13 = parseInt(document.getElementById("s12").value);

	var s21 = parseInt(document.getElementById("s21").value);
	var s22 = parseInt(document.getElementById("s22").value);
	var s23 = parseInt(document.getElementById("s23").value);

	var s31 = parseInt(document.getElementById("s31").value);
	var s32 = parseInt(document.getElementById("s32").value);
	var s33 = parseInt(document.getElementById("s33").value);
	

	var res = s11 * ((s22*s33) - (s32*s23)) - s21 * ((s12*s33) - (s32*s13)) + s31 * ((s12*s23) - (s22*s13));

	document.getElementById("result").innerHTML = res;
}