/*=============================================
VALIDAR MENSAJES
=============================================*/

function validarMensaje() {

    nombres = $("#nombres").val();
    email = $("#email").val();
    mensaje = $("#mensaje").val();
    asunto = $("#asunto").val();

    if (nombres != "") {

        var caracteres1 = nombres.length;
        var expresion1 = /^[a-zA-Z\s]*$/;

        if (!expresion1.test(nombres)) {

            $("#nombres").after('<div><small class="form-text text-danger">No se permiten números ni caracteres especiales.</small></div>');

            return false;
        }

    } else if (email != "") {

        var caracteres2 = email.length;
        var expresion2 = /^[a-zA-Z\s]*$/;

        if (!expresion2.test(email)) {

            $("#email").after('<div><small class="form-text text-danger">No se permiten números ni caracteres especiales.</small></div>');

            return false;
        }


    } else if (mensaje != "") {

        var caracteres3 = mensaje.length;
        var expresion3 = /^[a-zA-Z\s]*$/;

        if (!expresion3.test(mensaje)) {

            $("#mensaje").after('<div><small class="form-text text-danger">No se permiten números ni caracteres especiales.</small></div>');

            return false;
        }

    } else if (asunto != "") {

        var caracteres4 = asunto.length;
        var expresion4 = /^[a-zA-Z\s]*$/;

        if (!expresion4.test(asunto)) {

            $("#asunto").after('<div><small class="form-text text-danger">No se permiten números ni caracteres especiales.</small></div>');

            return false;
        }

    }

}