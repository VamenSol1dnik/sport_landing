document.addEventListener("DOMContentLoaded", () => {
    const newsList = document.querySelector(".news-list");
    const moreBtn = document.querySelector(".more-btn");

    let expanded = false;

    moreBtn.addEventListener("click", () => {
        if (!expanded) {
            newsList.style.maxHeight = "none"; 
            moreBtn.textContent = "Show Less"; 
        } else {
            newsList.style.maxHeight = "200px"; 
            moreBtn.textContent = "More"; 
        }
        expanded = !expanded; // Перемикає стан
    });
});