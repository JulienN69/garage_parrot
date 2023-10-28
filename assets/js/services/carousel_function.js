// ------ modifying carousel id depending on screen size ---------

const newCarouselId = "carouselExampleControls";

let carouselIdSmallScreen = document.querySelector("#carouselSmall");
let carouselIdMediumScreen = document.querySelector("#carouselMedium");
let carouselIdLargeScreen = document.querySelector("#carouselLarge");
console.log(carouselIdLargeScreen + "1");

function updateCarouselId() {
  if (window.innerWidth > 1200) {
    carouselIdLargeScreen.id = newCarouselId;
    carouselIdMediumScreen.id = "";
    carouselIdSmallScreen.id = "";
    console.log(carouselIdLargeScreen + "2");
  } else if (window.innerWidth <= 1200 && window.innerWidth > 768) {
    carouselIdLargeScreen.id = "";
    carouselIdMediumScreen.id = newCarouselId;
    carouselIdSmallScreen.id = "";
    console.log(carouselIdLargeScreen + "3");
  } else {
    carouselIdLargeScreen.id = "";
    carouselIdMediumScreen.id = "";
    carouselIdSmallScreen.id = newCarouselId;
    console.log(carouselIdLargeScreen + "4");
  }
}

updateCarouselId();

window.addEventListener("resize", updateCarouselId);
