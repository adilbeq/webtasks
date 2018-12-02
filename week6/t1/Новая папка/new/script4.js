let cities = ["Almaty","Astana","Karagandy"]


function changeFn(){
	let selectedValue = event.currentTarget.value;
	document.querySelector("#text").textContent = selectedValue;
}
function clickFn(){
	document.querySelector("select").disabled = false;
	document.querySelector("option").remove();
	for (let city of cities){
		let cityItem = document.createElement("option");	
		cityItem.textContent = city;
		document.querySelector("select").appendChild(cityItem);
	}	
	
}


document.querySelector("select").addEventListener("change",changeFn);
document.querySelector("button").addEventListener("click",clickFn);
