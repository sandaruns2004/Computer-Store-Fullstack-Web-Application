const rangeInput = document.querySelectorAll(".range-input input");
pricelabel  = document.querySelectorAll(".pricelabel span");
progress = document.querySelector(".slider .progress");

let priceGap = 20000;
rangeInput.forEach(input => {
    input.addEventListener("input", e => {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (e.target.className == "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            pricelabel[0].innerHTML = minVal;
            pricelabel[1].innerHTML = maxVal;
            progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});