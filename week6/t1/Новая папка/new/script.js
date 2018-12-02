/*let cars = [{"maker":"Toyota","model":"Camry 50","price":"40000"},{"maker":"Mercedes","model":"C100","price":"20000"},{"maker":"Toyota","model":"Camry 50","price":"40000"}];
*/
function clickFn(){
	let target = event.currentTarget;
	//target.style.background = "red";
	//target.textContent = "<strong>Bye-bye</strong>";
	//target.remove();
	target.textContent = target.dataset.translation;
}
function clickButton(){
	let divItem = document.createElement("div");
	divItem.textContent = "New item";
	document.querySelector("#container").appendChild(divItem);
}


/*let items = document.querySelectorAll("div.top");
for (let item of items){
	item.style.border="1px solid blue";
}*/
/*
for (let item of items){
	item.addEventListener("click",clickFn);
}*/

document.querySelector("#addNew").addEventListener("click",clickButton);

let bookmarkButtons = document.querySelectorAll("button.bookmark");
for (let button of bookmarkButtons){
	button.addEventListener('click',bookmark);
}

function bookmark(){
	let divItem = event.currentTarget.parentNode;
	if (divItem.dataset.bookmarked === "true"){
		divItem.dataset.bookmarked = "false";
		event.currentTarget.parentNode.classList.remove("bookmark");
		event.currentTarget.textContent = "Bookmark";
	}
	else{
		divItem.dataset.bookmarked = "true";
		event.currentTarget.parentNode.classList.add("bookmark");
		event.currentTarget.textContent = "Bookmarked";
	}
}

