let countries = ["Kazakhstan","Russia","England","France"];
let cities_by_country = {"Kazakhstan":["Almaty","Astana","Karagandy"],"Russia":["Moscow","Saint-Petersburg","Kazan"],"England":["London","Manchester","Liverpool"],"France":["Paris","Lyon","Marseille"]};

for (let countriesOne of countries){
	let cityItem = document.createElement("option");	
	cityItem.textContent = countriesOne;
	document.querySelector("#countries").appendChild(cityItem);
}
var one = 0;
function changeFn(){
	var selected = document.getElementById("countries").value;
	var asd = cities_by_country[selected];
	var allCounty = document.querySelectorAll("#countries option");
	if (one == 0){
		document.querySelector("option").remove();
		one = 1;
	}
	document.querySelectorAll("#cities option").forEach(e => e.parentNode.removeChild(e));

	for(let city in asd){
		let zxc = document.createElement("option");
		zxc.textContent = asd[city];
		document.querySelector("#cities").appendChild(zxc);
	}
}

document.querySelector("select").addEventListener("change", changeFn);
