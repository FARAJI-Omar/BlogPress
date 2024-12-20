const articles = document.querySelector('.articles');
const createBtn = document.querySelector('.createBtn');
const closeBtn = document.querySelector('#close');
const createArticleBox = document.querySelector('.createArticleBox');
const boxContent = document.querySelector('.boxContent'); 
const overlay = document.querySelector('.overlay');




articles.addEventListener('click', ()=>{
    window.location.href = 'articles.php';
});

createArticleBox.style.display = "none";

createBtn.addEventListener('click', () => {
    createArticleBox.style.display = "flex";
});

closeBtn.addEventListener('click', () => {
    createArticleBox.style.display = "none";
    overlay.style.display = 'none';

});




