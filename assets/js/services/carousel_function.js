// ------ modifying carousel id depending on screen size ---------

const newCarouselId = "carouselExampleControls";

let carouselIdSmallScreen = document.querySelector("#carouselSmall");
let carouselIdMediumScreen = document.querySelector("#carouselMedium");
let carouselIdLargeScreen = document.querySelector("#carouselLarge");

function updateCarouselId() {
  if (window.innerWidth > 1200) {
    carouselIdLargeScreen.id = newCarouselId;
    carouselIdMediumScreen.id = "";
    carouselIdSmallScreen.id = "";
  } else if (window.innerWidth <= 1200 && window.innerWidth > 768) {
    carouselIdLargeScreen.id = "";
    carouselIdMediumScreen.id = newCarouselId;
    carouselIdSmallScreen.id = "";
  } else {
    carouselIdLargeScreen.id = "";
    carouselIdMediumScreen.id = "";
    carouselIdSmallScreen.id = newCarouselId;
  }
}

updateCarouselId();

window.addEventListener("resize", updateCarouselId);
