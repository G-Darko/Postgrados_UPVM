const slides = document.querySelectorAll(".slide");
const right = document.getElementById("btn-right");
const left = document.getElementById("btn-left");
let counter = 0;

slides.forEach((slide, index) =>{
	slide.style.left = `${index * 100}%`
});

left.onclick = function(){
	if (counter == 0) {
		counter = slides.length - 1;
		slideImg();
	} else{
		counter--;
		slideImg()
	}
}

const next = () =>{
	if (counter == slides.length - 1) {
		counter = 0;
		slideImg();
	} else{
		counter++;
		slideImg()
	}
}

right.onclick = function(){
	next();
}

const slideImg = () =>{
	slides.forEach((slide) =>{
		slide.style.transform = `translateX(-${counter * 100}%)`
	});
}


setInterval(() => {
	next()
}, 7000);