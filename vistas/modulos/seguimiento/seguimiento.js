/* $("#ccnum").keyup(function (e) {
    var num = $(this).val().toString();
    var charCount = num.length;

    
    if (charCount == 1) {
        if (num == "4") {
            $("#type").html('<img class="img_card " src="https://img.icons8.com/color/48/000000/visa.png"/>');
        }
    }
    if (charCount == 2) {
        if (num == "34" || num == "37") {
            $("#type").html("AMEX");
        } else if (num == "51" || num == "55" || num == "53") {
            $("#type").html('<img class="img_card"  src="https://img.icons8.com/fluent/48/000000/mastercard.png"/>');
        } else if (num == "55") {
            $("#type").html("DISCOVER");
        }
    }
    if (charCount == 3) {
        if (num == "644") {
            $("#type").html('<img class="img_card" src="https://img.icons8.com/color/48/000000/discover.png"/>')
        }
    }
    if (charCount == 4) {
        if (num == "6011") {
            $("#type").html('<img class="img_card" src="https://img.icons8.com/color/48/000000/discover.png"/>');
        }
    }
    
    if (charCount == 13 || charCount == 14 || charCount == 15 || charCount == 16) {
        var valid = isValid(num, charCount);
        if (valid) {

        } else {
            $("#type").html('<img class="img_card" class="img_card" src="https://img.icons8.com/android/32/000000/bank-card-back-side.png"/>');
        }
    }
   
});*/

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



function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(/\d{4,16}/g);
    var match = matches && matches[0] || ''
    var parts = []
    for (i = 0, len = match.length; i < len; i += 4) {
        parts.push(match.substring(i, i + 4))
    }
    if (parts.length) {
        return parts.join(' ')
    } else {
        return value
    }
}

onload = function () {
    document.getElementById('ccnum').oninput = function () {
        this.value = cc_format(this.value)

        var num = $(this).val().toString();
        var charCount = num.length;

        /* VALIDACION DE TIPO */
        if (charCount == 1) {
            if (num == "4") {
                $("#type").html('<img class="img_card " src="https://img.icons8.com/color/48/000000/visa.png"/>');
            }
        }
        if (charCount == 2) {
            if (num == "34" || num == "37") {
                $("#type").html("AMEX");
            } else if (num == "51" || num == "55" || num == "53") {
                $("#type").html('<img class="img_card"  src="https://img.icons8.com/fluent/48/000000/mastercard.png"/>');
            } else if (num == "55") {
                $("#type").html("DISCOVER");
            }
        }
        if (charCount == 3) {
            if (num == "644") {
                $("#type").html('<img class="img_card" src="https://img.icons8.com/color/48/000000/discover.png"/>')
            }
        }
        if (charCount == 4) {
            if (num == "6011") {
                $("#type").html('<img class="img_card" src="https://img.icons8.com/color/48/000000/discover.png"/>');
            }
        }
        /* !VALIDACION DE TIPO */

        /* ALGORITMO */
        if (charCount == 13 || charCount == 14 || charCount == 15 || charCount == 16) {
            var valid = isValid(num, charCount);
            if (valid) {

            } else {
                $("#type").html('<img class="img_card" class="img_card" src="https://img.icons8.com/android/32/000000/bank-card-back-side.png"/>');
            }
        }

    }
}
function checkDigit(event) {
    var code = (event.which) ? event.which : event.keyCode;

    if ((code < 48 || code > 57) && (code > 31)) {
        return false;
    }

    return true;
}