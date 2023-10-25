import { updateBackground, gapSlider } from "./functions_car";

window.onload = function () {
  inputPrice1.value = 0;
  spanPrice1.innerText =
    new Intl.NumberFormat("fr-FR").format(inputPrice1.value) + " €";
  inputPrice2.value = 150000;
  spanPrice2.innerText =
    new Intl.NumberFormat("fr-FR").format(inputPrice2.value) + " €";
  inputMiles1.value = 0;
  spanMiles1.innerText =
    new Intl.NumberFormat("fr-FR").format(inputMiles1.value) + " km";
  inputMiles2.value = 200000;
  spanMiles2.innerText =
    new Intl.NumberFormat("fr-FR").format(inputMiles2.value) + " km";
  inputYear1.value = 1980;
  inputYear2.value = 2023;
  sliderTrackPrice.style.background = "#dd2424";
  sliderTrackMiles.style.background = "#dd2424";
};
// --------- Recovering DOM elements --------------

let inputPrice1 = document.getElementById("search_car_form_priceMin");
let inputPrice2 = document.getElementById("search_car_form_priceMax");
let spanPrice1 = document.getElementById("spanPrice1");
let spanPrice2 = document.getElementById("spanPrice2");
let sliderTrackPrice = document.getElementById("filterButtonSliderPrice");

let inputMiles1 = document.getElementById("search_car_form_milesMin");
let inputMiles2 = document.getElementById("search_car_form_milesMax");
let spanMiles1 = document.getElementById("spanMiles1");
let spanMiles2 = document.getElementById("spanMiles2");
let sliderTrackMiles = document.getElementById("filterButtonSliderMiles");

let inputYear1 = document.getElementById("search_car_form_yearMin");
let inputYear2 = document.getElementById("search_car_form_yearMax");

// ------------- events inputs listenners -----------------

inputPrice1.addEventListener("input", (event) => {
  spanPrice1.innerText =
    new Intl.NumberFormat("fr-FR").format(event.target.value) + " €";
  inputPrice1.value = event.target.value;

  updateBackground(
    inputPrice1,
    inputPrice1.value,
    inputPrice2.value,
    sliderTrackPrice
  );
  gapSlider(inputPrice1, inputPrice2, spanPrice1, spanPrice2, 10, " €");
});

inputPrice2.addEventListener("input", (event) => {
  inputPrice2.value = event.target.value;
  spanPrice2.innerText =
    new Intl.NumberFormat("fr-FR").format(event.target.value) + " €";
  updateBackground(
    inputPrice2,
    inputPrice1.value,
    inputPrice2.value,
    sliderTrackPrice
  );
  gapSlider(inputPrice1, inputPrice2, spanPrice1, spanPrice2, 100, " €");
});

inputMiles1.addEventListener("input", (event) => {
  inputMiles1.value = event.target.value;
  spanMiles1.innerText =
    new Intl.NumberFormat("fr-FR").format(event.target.value) + " km";
  updateBackground(
    inputMiles1,
    inputMiles1.value,
    inputMiles2.value,
    sliderTrackMiles
  );
  gapSlider(inputMiles1, inputMiles2, spanMiles1, spanMiles2, 100, " km");
});

inputMiles2.addEventListener("input", (event) => {
  inputMiles2.value = event.target.value;
  spanMiles2.innerText =
    new Intl.NumberFormat("fr-FR").format(event.target.value) + " km";
  updateBackground(
    inputMiles2,
    inputMiles1.value,
    inputMiles2.value,
    sliderTrackMiles
  );
  gapSlider(inputMiles1, inputMiles2, spanMiles1, spanMiles2, 100, " km");
});

// ------------------- reset button -------------------------

let resetButton = document.getElementById("reset-button");
let carFilterForm = document.getElementById("form-car");

resetButton.addEventListener("click", () => {
  inputPrice1.value = 0;
  spanPrice1.innerText =
    new Intl.NumberFormat("fr-FR").format(inputPrice1.value) + " €";
  inputPrice2.value = 150000;
  spanPrice2.innerText =
    new Intl.NumberFormat("fr-FR").format(inputPrice2.value) + " €";
  inputMiles1.value = 0;
  spanMiles1.innerText =
    new Intl.NumberFormat("fr-FR").format(inputMiles1.value) + " km";
  inputMiles2.value = 200000;
  spanMiles2.innerText =
    new Intl.NumberFormat("fr-FR").format(inputMiles2.value) + " km";
  inputYear1.value = 1980;
  inputYear2.value = 2023;
  sliderTrackPrice.style.background = "#dd2424";
  sliderTrackMiles.style.background = "#dd2424";
  carFilterForm.reset();
  carFilterForm.submit();
});

// --------------------- Modal -------------------------

function changeScriptInModal() {
  if (window.innerWidth <= 768) {
    const modalButton = document.querySelector(".modalButton");
    modalButton.addEventListener("click", () => {
      carFilterForm.style.display = "block";
    });
    carFilterForm.classList.add("collapse show");
    carFilterForm.id = "collapseExample";
  } else {
    carFilterForm.classList.remove("collapse", "show");
    carFilterForm.id = "form-car";
  }
}

window.addEventListener("resize", changeScriptInModal);

changeScriptInModal();
