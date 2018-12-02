
function makeMagic(){
	var big = document.getElementById("big");
	var ima = document.getElementsByTagName("button")[0];

	ima.onclick = function(e) {
		big.src = "https://www.cstatic-images.com/car-pictures/xl/USC60AUC021B021001.png";
	}
}
var ima = document.getElementsByTagName("button")[0];
ima.addEventListener("click", makeMagic);
