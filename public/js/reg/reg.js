document.addEventListener('DOMContentLoaded', function(){
    let logBtn = document.querySelector('.signBtn');
    let signIn = document.querySelector('.wrapper');
    let regBtn = document.querySelector('.regBtn');
    logBtn.addEventListener('click', function(){
        signIn.classList.toggle('active');
    });
    regBtn.addEventListener('click', function(){
        signIn.classList.toggle('active');
    });
});
