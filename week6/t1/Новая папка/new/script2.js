let items = ["France","England"];
document.querySelector("select option").remove();
for (let item of items){
	let newItem = document.createElement("option");
	newItem.textContent = item;
	document.querySelector("select").appendChild(newItem);
}


function changeFn(){
	console.log(event.currentTarget.value);
}

document.querySelector("select").addEventListener("change",changeFn);
