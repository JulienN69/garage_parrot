window.onload = function () {
  inputPrice1.value = 0;
  inputPrice2.value = 100000;
  inputMiles1.value = 0;
  inputMiles2.value = 200000;
  sliderTrackPrice.style.background = "#dd2424";
  sliderTrackMiles.style.background = "#dd2424";
  console.log("fichier chargé");
};

// --------- Recovering DOM elements --------------

let inputPrice1 = document.getElementById("sliderPrice1");
let inputPrice2 = document.getElementById("sliderPrice2");
let spanPrice1 = document.getElementById("spanPrice1");
let spanPrice2 = document.getElementById("spanPrice2");
let sliderTrackPrice = document.getElementById("filterButtonSliderPrice");

let inputMiles1 = document.getElementById("sliderMiles1");
let inputMiles2 = document.getElementById("sliderMiles2");
let spanMiles1 = document.getElementById("spanMiles1");
let spanMiles2 = document.getElementById("spanMiles2");
let sliderTrackMiles = document.getElementById("filterButtonSliderMiles");

let inputYear1 = document.getElementById("inputYear1");
let inputYear2 = document.getElementById("inputYear2");

// ------------- events inputs for background and no overruns -----------------

let slidValue1;
let slidValue2;

inputPrice1.addEventListener("input", (event) => {
  slidValue1 = event.target.value;
  spanPrice1.innerText = slidValue1;
  updateBackground(inputPrice1, sliderTrackPrice);
  gapSliderbis(inputPrice1, inputPrice2, spanPrice1, spanPrice2, 10);
});

inputPrice2.addEventListener("input", (event) => {
  slidValue2 = event.target.value;
  spanPrice2.innerText = slidValue2;
  updateBackground(inputPrice2, sliderTrackPrice);
  gapSliderbis(inputPrice1, inputPrice2, spanPrice1, spanPrice2, 10);
});

inputMiles1.addEventListener("input", (event) => {
  slidValue1 = event.target.value;
  spanMiles1.innerText = slidValue1;
  updateBackground(inputMiles1, sliderTrackMiles);
  gapSliderbis(inputMiles1, inputMiles2, spanMiles1, spanMiles2, 10);
});

inputMiles2.addEventListener("input", (event) => {
  slidValue2 = event.target.value;
  spanMiles2.innerText = slidValue2;
  updateBackground(inputMiles2, sliderTrackMiles);
  gapSliderbis(inputMiles1, inputMiles2, spanMiles1, spanMiles2, 100);
});

// ---- no overruns function -----

function gapSliderbis(inputValue1, inputValue2, spanValue1, spanValue2, gap) {
  let value1 = parseInt(inputValue1.value, 10);
  let value2 = parseInt(inputValue2.value, 10);

  if (value2 <= value1 + gap) {
    value2 = value1 + gap;
    inputValue2.value = value2;
    slidValue2 = value2;
    spanValue2.innerText = value2;

    value1 = value2 - gap;
    inputValue1.value = value1;
    spanValue1.innerText = value1;
  }
}

// ---- changing background function ----

function updateBackground(input, sliderTrack) {
  let inputMax = input.max;

  if (slidValue1 !== undefined && slidValue2 !== undefined) {
    let percent1 = (slidValue1 / inputMax) * 100;
    let percent2 = (slidValue2 / inputMax) * 100;
    let percentInt1 = parseInt(percent1, 10);
    let percentInt2 = parseInt(percent2, 10);
    console.log(slidValue1, slidValue2);

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentInt1}%,
      #dd2424 ${percentInt1}%, #dd2424 ${percentInt2}%, #cdc2c2 ${percentInt2}%)`;
  } else if (slidValue1 !== undefined && slidValue2 == undefined) {
    let percent1 = (slidValue1 / inputMax) * 100;
    let percentInt1 = parseInt(percent1, 10);
    let percentInt2 = 100;

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentInt1}%,
      #dd2424 ${percentInt1}%, #dd2424 ${percentInt2}%, #cdc2c2 ${percentInt2}%)`;
  } else if (slidValue1 == undefined && slidValue2 !== undefined) {
    let percentInt1 = 0;
    let percent2 = (slidValue2 / inputMax) * 100;
    let percentInt2 = parseInt(percent2, 10);

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentInt1}%,
      #dd2424 ${percentInt1}%, #dd2424 ${percentInt2}%, #cdc2c2 ${percentInt2}%)`;
  }
}
