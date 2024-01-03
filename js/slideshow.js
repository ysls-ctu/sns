let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    slides[slideIndex - 1].classList.add("fade"); // Add fade class
    setTimeout(function () {
        slides[slideIndex - 1].classList.remove("fade"); // Remove fade class after transition
    }, 1500);
    setTimeout(showSlides, 4000); // Change image every 4 seconds
}