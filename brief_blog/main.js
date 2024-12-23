const articles = document.querySelector('.articles');
const createBtn = document.querySelector('.createBtn');
const closeBtn = document.querySelector('#close');
const createArticleBox = document.querySelector('.createArticleBox');
const boxContent = document.querySelector('.boxContent');
const createdart = document.querySelector('.createdart');


articles.addEventListener('click', ()=>{
    window.location.href = 'dashboard.php';
});

createArticleBox.style.display = "none";

createBtn.addEventListener('click', () => {
    createArticleBox.style.display = "flex";
    createdart.style.display = "none";
});

closeBtn.addEventListener('click', () => {
    createArticleBox.style.display = "none";
    createdart.style.display = "";

});







