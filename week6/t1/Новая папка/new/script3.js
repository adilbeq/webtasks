function clickFn(){
	let item = event.currentTarget;
	if (item.dataset.status==="yes"){
		//item.classList.remove("highlight");
		item.dataset.status = "no";
	}	
	else{
		//item.classList.add("highlight");
		item.dataset.status = "yes";
	}
	//item.remove();
}
function clickButtonFn(){
	let newItem = document.createElement("div");
	newItem.textContent="Privet";
	let body = document.querySelector("body");
	body.appendChild(newItem);
	/*let body = document.querySelector("body");
	body.innerHTML  = body.innerHTML+"<div>Privet</div>";*/
}

let items = document.querySelectorAll("div");

for (let item of items){
	item.style.border="1px solid blue";
	item.addEventListener("click",clickFn);
}
document.querySelector("button").addEventListener("click",clickButtonFn);

let removeButtons = document.querySelectorAll("button.remove");
for (let button of removeButtons){
	button.addEventListener("click",removeButtonFn);
}

function removeButtonFn(){
	event.currentTarget.parentNode.remove();
	event.stopPropagation();
}





