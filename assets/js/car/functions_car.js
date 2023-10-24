// ---- no overruns function -----

export function gapSlider(
  inputValue1,
  inputValue2,
  spanValue1,
  spanValue2,
  gap,
  unit
) {
  let value1 = parseInt(inputValue1.value, 10);
  let value2 = parseInt(inputValue2.value, 10);

  if (value2 <= value1 + gap) {
    value2 = value1 + gap;
    inputValue2.value = value2;
    slidValue2 = value2;
    spanValue2.innerText = new Intl.NumberFormat("fr-FR").format(value2) + unit;

    value1 = value2 - gap;
    inputValue1.value = value1;
    spanValue1.innerText = new Intl.NumberFormat("fr-FR").format(value1) + unit;
  } else if ((value1 = value2 + gap)) {
    value2 = value1 + gap;
    inputValue2.value = value2;
    spanValue2.innerText = new Intl.NumberFormat("fr-FR").format(value2) + unit;
  }
}

// ---- changing background function ----

export function updateBackground(
  input,
  inputValueMin,
  inputValueMax,
  sliderTrack
) {
  let inputMax = input.max;

  if (inputValueMin !== undefined && inputValueMax !== undefined) {
    let percentMin = (inputValueMin / inputMax) * 100;
    let percentMax = (inputValueMax / inputMax) * 100;
    let percentIntMin = parseInt(percentMin, 10);
    let percentIntMax = parseInt(percentMax, 10);

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentIntMin}%,
        #dd2424 ${percentIntMin}%, #dd2424 ${percentIntMax}%, #cdc2c2 ${percentIntMax}%)`;
  } else if (inputValueMin !== undefined && inputValueMax == undefined) {
    let percentMin = (inputValueMin / inputMax) * 100;
    let percentIntMin = parseInt(percentMin, 10);
    let percentIntMax = 100;

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentIntMin}%,
        #dd2424 ${percentIntMin}%, #dd2424 ${percentIntMax}%, #cdc2c2 ${percentIntMax}%)`;
  } else if (inputValueMin == undefined && inputValueMax !== undefined) {
    let percentIntMin = 0;
    let percentMax = (inputValueMax / inputMax) * 100;
    let percentIntMax = parseInt(percentMax, 10);

    sliderTrack.style.background = `linear-gradient(to right, #cdc2c2 ${percentIntMin}%,
        #dd2424 ${percentIntMin}%, #dd2424 ${percentIntMax}%, #cdc2c2 ${percentIntMax}%)`;
  }
}
