var inputs = document.querySelectorAll("#phone");
var inputs2 = document.querySelectorAll("#phone2");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
inputs.forEach(input => {

    // initialise plugin
    url = $("meta[name='full-url']").attr('content') + "/js/utils.js"
    var iti = window.intlTelInput(input, {
        utilsScript: url,
        preferredCountries: ["eg", "sa"],
    });

    var reset = function() {
        input.classList.remove("error");
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg').innerHTML = "";
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg').classList.add("hide");
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#valid-msg').classList.add("hide");
    };

    // on blur: validate
    input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()) {
            if (iti.isValidNumber()) {
                number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                input.value = number
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#valid-msg').classList.remove("hide");
            } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError();
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg').innerHTML = errorMap[errorCode];
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg').classList.remove("hide");
            }
        }
    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

});

inputs2.forEach(input => {

    // initialise plugin
    url = $("meta[name='full-url']").attr('content') + "/js/utils.js"
    var iti = window.intlTelInput(input, {
        utilsScript: url,
        preferredCountries: ["eg", "sa"],
    });

    var reset = function() {
        input.classList.remove("error");
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg2').innerHTML = "";
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg2').classList.add("hide");
        input.parentElement.parentElement.parentElement.parentElement.querySelector('#valid-msg2').classList.add("hide");
    };

    // on blur: validate
    input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()) {
            if (iti.isValidNumber()) {
                number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                input.value = number
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#valid-msg2').classList.remove("hide");
            } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError();
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg2').innerHTML = errorMap[errorCode];
                input.parentElement.parentElement.parentElement.parentElement.querySelector('#error-msg2').classList.remove("hide");
            }
        }
    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);

})