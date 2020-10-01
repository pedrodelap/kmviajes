$("#ccnum").keyup(function (e) {
    var num = $(this).val().toString();
    var charCount = num.length;

    /* VALIDACION DE TIPO */
    if (charCount == 1) {
        if (num == "4") {
            $("#type").html('<img src="https://img.icons8.com/color/20/000000/visa.png"/>');
        }
    }
    if (charCount == 2) {
        if (num == "34" || num == "37") {
            $("#type").html("AMEX");
        } else if (num == "51" || num == "55" || num == "53") {
            $("#type").html('<img src="https://img.icons8.com/officel/20/000000/mastercard.png"/>');
        } else if (num == "55") {
            $("#type").html("DISCOVER");
        }
    }
    if (charCount == 3) {
        if (num == "644") {
            $("#type").html("DISCOVER")
        }
    }
    if (charCount == 4) {
        if (num == "6011") {
            $("#type").html("DISCOVER");
        }
    }
    /* !VALIDACION DE TIPO */

    /* ALGORITMO */
    if (charCount == 13 || charCount == 14 || charCount == 15 || charCount == 16) {
        var valid = isValid(num, charCount);
        if (valid) {

        } else {

        }
    }
    /* !ALGORITMO */
});

function isValid(ccNum, charCount) {
    var double = true;
    var numArr = [];
    var sumTotal = 0;
    for (i = 0; i < charCount; i++) {
        var digit = parseInt(ccNum.charAt(i));

        if (double) {
            digit = digit * 2;
            digit = toSingle(digit);
            double = false;
        } else {
            double = true;
        }
        numArr.push(digit);
    }

    for (i = 0; i < numArr.length; i++) {
        sumTotal += numArr[i];
    }
    var diff = eval(sumTotal % 10);
    console.log(diff);
    console.log(diff == "0");
    return (diff == "0");
}

function toSingle(digit) {
    if (digit > 9) {
        var tmp = digit.toString();
        var d1 = parseInt(tmp.charAt(0));
        var d2 = parseInt(tmp.charAt(1));
        return (d1 + d2);
    } else {
        return digit;
    }
}