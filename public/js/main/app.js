let menuBtn = document.querySelector('.burger');
let hidenMenu = document.querySelector('.hidden-menu');
let menu = document.querySelector('.menu');
menuBtn.addEventListener('click', function(){
	hidenMenu.classList.toggle('active');
    menu.classList.toggle('active');
})