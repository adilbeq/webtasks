/*
document.click(function(event)){
	alert(event.currentTarget);
}
*/

function makeMagic(){
	var big = document.getElementById("big");
/*
	var image = document.getElementById("small2");
	big.src = image.src;


	var image = document.getElementById("small3");
	big.src = image.src;
*/
	var image4 = document.getElementById("small4");
	image4.onclick = function(e) {
		big.src = image4.src;
	}

	var image1 = document.getElementById("small1");
	image1.onclick = function(e) {
		big.src = image1.src;
	}

	var image2 = document.getElementById("small2");
	image2.onclick = function(e) {
		big.src = image2.src;
	}

	var image3 = document.getElementById("small3");
	image3.onclick = function(e) {
		big.src = image3.src;
	}

	var image5 = document.getElementById("small5");
	image5.onclick = function(e) {
		big.src = image5.src;
	}
}